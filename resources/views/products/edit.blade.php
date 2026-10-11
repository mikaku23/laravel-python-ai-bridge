@extends('layouts.app')

@section('title', 'Edit Produk | POS Python Bridge')

@section('content')
    <div class="topbar">
        <div>
            <h1>Edit produk</h1>
            <p class="muted">Perbarui data {{ $product->name }}.</p>
        </div>
    </div>
    <section class="card">
        <form method="POST" action="{{ route('products.update', $product) }}">
            @csrf
            @method('PUT')
            @include('products._form')
        </form>
    </section>
@endsection
