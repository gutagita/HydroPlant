@extends('layouts.app')

@section('title', $product->name . ' - HydroPlant')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-6 body-font text-sm text-gray-600">
            <a href="{{ url('/') }}" class="hover:text-primary">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/products') }}" class="hover:text-primary">Produk</a>
            <span class="mx-2">/</span>
            <span class="text-gray-400">{{ $product->name }}</span>
        </nav>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Product Images -->
                <div class="md:w-1/2 p-8">
                    <div class="bg-gray-100 rounded-lg h-96 flex items-center justify-center">
                        @php
                            $productImages = is_array($product->images) ? $product->images : (json_decode($product->images, true) ?? []);
                        @endphp
                        
                        @if(count($productImages) > 0)
                           <img src="{{ asset('storage/' . $productImages[0]) }}"
                                 alt="{{ $product->name }}" 
                                 class="max-h-80 object-cover rounded">
                        @else
                            <div class="text-gray-400 text-center">
                                <span class="text-6xl">🌱</span>
                                <p class="mt-2 body-font">No Image Available</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="md:w-1/2 p-8">
                    <!-- Category -->
                    <span class="inline-block px-3 py-1 bg-light text-primary rounded-full text-sm font-semibold mb-4">
                        {{ $product->category->name }}
                    </span>

                    <!-- Product Name -->
                    <h1 class="header-font text-3xl font-bold text-gray-800 mb-4">
                        {{ $product->name }}
                    </h1>

                    <!-- Price -->
                    <div class="flex items-center mb-6">
                        <span class="header-font text-4xl font-bold text-primary">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        @if($product->is_featured)
                        <span class="ml-4 px-3 py-1 bg-red-600 text-white rounded-full text-sm font-semibold">
                            ⭐ Best Seller
                        </span>
                        @endif
                    </div>

                    <!-- Stock -->
                    <div class="mb-6">
                        <span class="body-font text-lg font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock > 0 ? '✅ Stok Tersedia: ' . $product->stock : '❌ Stok Habis' }}
                        </span>
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <h3 class="header-font text-xl font-semibold text-gray-800 mb-3">Deskripsi Produk</h3>
                        <p class="body-font text-gray-600 leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4">
                        <button class="flex-1 bg-gray-200 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-300 transition duration-300 body-font font-semibold">
                            🛒 Tambah Keranjang
                        </button>
                        <button class="flex-1 bg-primary text-white py-3 px-6 rounded-lg hover:bg-secondary transition duration-300 body-font font-semibold">
                            💳 Beli Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ url('/products') }}" 
               class="inline-flex items-center text-primary hover:text-secondary transition duration-300 body-font font-semibold">
                ← Kembali ke Daftar Produk
            </a>
        </div>
    </div>
</div>
@endsection