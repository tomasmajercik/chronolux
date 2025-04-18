<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class ProductController extends Controller
{
    public function showByCategory(Request $request, $category_name = null)
    {
        // Handle category if present
        if ($category_name) {
            $category = Category::where('category_name', $category_name)->firstOrFail();
            $category_name = $category->category_name;
            $products = $category->products();
        } else {
            // If no category, fetch all products
            $category_name = 'All Products';
            $products = Product::query();
        }

        // Filter by brand (if provided)
        if ($request->filled('brand') && $request->brand != 'all') {
            $products->whereHas('brand', function ($query) use ($request) {
                $query->where('brand_name', $request->brand);  // Filter by brand name
            });
        }

        // Filter by size (if provided)
        if ($request->filled('sizes')) {
            $sizes = $request->input('sizes'); // Toto je pole veľkostí
        
            $products->whereHas('variants', function ($query) use ($sizes) {
                $query->whereIn('size', $sizes);
            });
        }

        // Filter by price range (if provided)
        if ($request->filled('price_min')) {
            $products->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $products->where('price', '<=', $request->price_max);
        }

        if ($request->has('sort_price')) {
            if ($request->sort_price === 'low-to-high') {
                $products->orderBy('price', 'asc');
            } elseif ($request->sort_price === 'high-to-low') {
                $products->orderBy('price', 'desc');
            }
        }
        
        if ($request->has('sort_name')) {
            if ($request->sort_name === 'a-z') {
                $products->orderBy('name', 'asc');
            } elseif ($request->sort_name === 'z-a') {
                $products->orderBy('name', 'desc');
            }
        }

        // Paginate the results
        $products = $products->with('coverImage')->paginate(12);

        // Get the total product count
        $productCount = $products->total();

        return view('product_page', [
            'category_name' => $category_name,
            'products' => $products,
            'productCount' => $productCount,
            'categories' => Category::all(),
            'brands' => Brand::all(),  
            'brand_name' => $request->brand,
        ]);
    }

    public function showProductDetail($id)
    {
        $product = Product::with('coverImage')->findOrFail($id);
        return view('product_detail', compact('product'));
    }
}