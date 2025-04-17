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
        $products = $category->products()->paginate(12);
        $productCount = $products->count();

        return view('product_page', [
            'category_name' => $category->category_name,
            'products' => $products,
            'productCount' => $productCount,
        ]);
    }
}