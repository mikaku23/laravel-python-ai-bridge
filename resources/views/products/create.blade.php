@extends('layouts.app')

@section('title', 'Tambah Produk | POS Python Bridge')

@section('content')
    <div class="topbar">
        <div>
            <h1>Tambah produk</h1>
            <p class="muted">Data produk disimpan oleh Laravel ke MySQL.</p>
        </div>
    </div>
    <section class="card">
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            @include('products._form')
        </form>
    </section>
@endsection
