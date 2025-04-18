<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function showByCategory($category_name)
    {
        $category = Category::where('category_name', $category_name)->firstOrFail();
        $products = $category->products()->paginate(2);
        $productCount = $products->total();

        return view('product_page', [
            'category_name' => $category->category_name,
            'products' => $products,
            'productCount' => $productCount,
        ]);
    }

    public function showProductDetail($id)
    {
        $product = Product::with('coverImage')->findOrFail($id);
        return view('product_detail', compact('product'));
    }
}