<div class="form-grid">
    <div class="field">
        <label for="sku">SKU / Kode produk</label>
        <input id="sku" name="sku" value="{{ old('sku', $product->sku) }}" maxlength="80" required>
        @error('sku') <span class="field-error">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <label for="name">Nama produk</label>
        <input id="name" name="name" value="{{ old('name', $product->name) }}" maxlength="255" required>
        @error('name') <span class="field-error">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <label for="price">Harga (Rp)</label>
        <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $product->price ?? '0.00') }}" required>
        @error('price') <span class="field-error">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <label for="stock">Stok saat ini</label>
        <input id="stock" name="stock" type="number" min="0" step="1" value="{{ old('stock', $product->stock ?? 0) }}" required>
        @error('stock') <span class="field-error">{{ $message }}</span> @enderror
    </div>
    <div class="field full">
        <label for="minimum_stock">Batas minimum stok</label>
        <input id="minimum_stock" name="minimum_stock" type="number" min="0" step="1" value="{{ old('minimum_stock', $product->minimum_stock ?? 5) }}" required>
        @error('minimum_stock') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{ $product->exists ? 'Simpan perubahan' : 'Simpan produk' }}</button>
    <a class="btn btn-light" href="{{ route('products.index') }}">Batal</a>
</div>
