@extends('layouts.app')

@section('title', 'Produk | POS Python Bridge')

@section('content')
    <div class="topbar">
        <div>
            <h1>Produk</h1>
            <p class="muted">CRUD Laravel dengan analisis stok yang diproses oleh Python.</p>
            @if ($pythonOnline)
                <span class="status status-online">Python API terhubung</span>
            @else
                <span class="status status-offline">Python API tidak tersedia</span>
            @endif
        </div>
        <a class="btn btn-primary" href="{{ route('products.create') }}">＋ Tambah produk</a>
    </div>

    <section class="card">
        @if ($products->isEmpty())
            <h2>Belum ada produk</h2>
            <p class="muted">Tambahkan produk pertama. Setelah disimpan, Laravel akan mengirim datanya ke Python untuk dianalisis.</p>
            <a class="btn btn-primary" href="{{ route('products.create') }}">Tambah produk pertama</a>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Analisis Python</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        @php($result = $analysis->get($product->id))
                        <tr>
                            <td>
                                <strong>{{ $product->name }}</strong>
                                <small>SKU: {{ $product->sku }}</small>
                            </td>
                            <td>Rp {{ number_format((float) $product->price, 0, ',', '.') }}</td>
                            <td>
                                <strong>{{ $product->stock }}</strong>
                                <small>Minimum: {{ $product->minimum_stock }}</small>
                            </td>
                            <td>
                                @if ($result)
                                    @if (($result['status'] ?? '') === 'Habis')
                                        <span class="status badge-habis">Habis</span>
                                    @elseif (($result['status'] ?? '') === 'Menipis')
                                        <span class="status badge-menipis">Menipis</span>
                                    @else
                                        <span class="status badge-aman">Aman</span>
                                    @endif
                                    <small>{{ $result['recommendation'] ?? '' }}</small>
                                @else
                                    <span class="muted">Tidak ada hasil dari Python.</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-light btn-small" href="{{ route('products.edit', $product) }}">Edit</a>
                                    <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-small" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <p class="note">Catatan: label stok saat ini menggunakan aturan sederhana di Python, bukan model machine learning.</p>
    </section>
@endsection
