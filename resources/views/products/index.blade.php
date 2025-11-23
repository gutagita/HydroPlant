@extends('layouts.app')

@section('title', 'Semua Produk - HydroPlant')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="header-font text-4xl font-bold text-primary mb-4">
            Semua Produk HydroPlant
        </h1>
        <p class="body-font text-lg text-gray-600 max-w-2xl mx-auto">
            Temukan berbagai kebutuhan hidroponik terbaik untuk kesuksesan bertanam Anda
        </p>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
            <!-- Product Image -->
            <div class="h-48 bg-gray-200 overflow-hidden">
                @php
                    // Handle both array and JSON string
                    $productImages = is_array($product->images) ? $product->images : (json_decode($product->images, true) ?? []);
                @endphp
                
                @if(count($productImages) > 0)
                    <img src="{{ asset('storage/' . $productImages[0]) }}"
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="p-6">
                <!-- Category Badge -->
                <span class="inline-block px-3 py-1 bg-light text-primary rounded-full text-xs font-semibold">
                    {{ $product->category->name }}
                </span>

                <!-- Product Name -->
                <h3 class="header-font text-xl font-semibold text-gray-800 mt-3 mb-2">
                    {{ $product->name }}
                </h3>

                <!-- Product Description -->
                <p class="body-font text-gray-600 text-sm mb-4 line-clamp-2">
                    {{ Str::limit($product->description, 80) }}
                </p>

                <!-- Price & Stock -->
                <div class="flex justify-between items-center mb-4">
                    <span class="header-font text-2xl font-bold text-primary">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    <span class="body-font text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Stok Habis' }}
                    </span>
                </div>

                <!-- Featured Badge -->
                @if($product->is_featured)
                <div class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded-full text-xs font-semibold mb-3">
                    ⭐ Best Seller
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex space-x-2">
                    <a href="{{ url('/products/' . $product->id) }}" 
                       class="flex-1 bg-primary text-white text-center py-2 px-4 rounded-lg hover:bg-secondary transition duration-300 body-font font-semibold">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($products->count() == 0)
    <div class="text-center py-12">
        <div class="text-6xl mb-4">🌱</div>
        <h3 class="header-font text-2xl font-semibold text-gray-600 mb-2">
            Belum ada produk
        </h3>
        <p class="body-font text-gray-500">
            Produk akan segera tersedia
        </p>
    </div>
    @endif
</div>
@endsection