<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::ordered()->get();
        $categories = $products->pluck('category')->filter()->unique()->values();

        return view('katalog', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        // Produk sekategori dulu, lalu dilengkapi produk lain sampai 3.
        $related = Product::whereKeyNot($product->id)
            ->when($product->category, fn ($q) => $q->where('category', $product->category))
            ->ordered()->take(3)->get();
        if ($related->count() < 3) {
            $related = $related->concat(
                Product::whereKeyNot($product->id)->whereNotIn('id', $related->pluck('id'))
                    ->ordered()->take(3 - $related->count())->get()
            );
        }

        return view('product-detail', compact('product', 'related'));
    }
}
