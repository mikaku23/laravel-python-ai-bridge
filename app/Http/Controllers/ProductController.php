<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->latest()->get();
        $analysis = collect();
        $pythonOnline = false;

        try {
            $payload = $products->map(fn (Product $product): array => [
                'id' => $product->id,
                'name' => $product->name,
                'stock' => $product->stock,
                'minimum_stock' => $product->minimum_stock,
            ])->values()->all();

            $baseUrl = rtrim((string) config('python_ai.url'), '/');

            $response = Http::connectTimeout(1)
                ->timeout(3)
                ->acceptJson()
                ->post($baseUrl . '/analyze-stocks', [
                    'products' => $payload,
                ]);

            $response->throw();

            $analysis = collect($response->json('results', []))
                ->keyBy('product_id');
            $pythonOnline = true;
        } catch (\Throwable $exception) {
            // CRUD tetap berfungsi walaupun Python sedang tidak aktif.
            report($exception);
        }

        return view('products.index', compact(
            'products',
            'analysis',
            'pythonOnline'
        ));
    }

    public function create(): View
    {
        return view('products.create', [
            'product' => new Product(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'sku' => ['required', 'string', 'max:80', 'unique:products,sku'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'minimum_stock' => ['required', 'integer', 'min:0'],
        ]);

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'sku' => [
                'required',
                'string',
                'max:80',
                Rule::unique('products', 'sku')->ignore($product->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'minimum_stock' => ['required', 'integer', 'min:0'],
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
