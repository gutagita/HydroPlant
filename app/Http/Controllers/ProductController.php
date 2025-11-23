<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan semua produk
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Menampilkan produk featured (best seller)
     */
    public function featured()
    {
        $products = Product::with('category')
                          ->where('is_featured', true)
                          ->get();
        
        return view('products.featured', compact('products'));
    }

    /**
     * Menampilkan detail satu produk
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}