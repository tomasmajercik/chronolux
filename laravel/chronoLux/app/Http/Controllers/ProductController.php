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

        if ($request->filled('search')) {
            $search = trim($request->search);
            $products->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                      ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }

        // Filter by brand (if provided)
        if ($request->filled('brand') && $request->brand != 'all') {
            $products->whereHas('brand', function ($query) use ($request) {
                $query->where('brand_name', $request->brand);  // Filter by brand name
            });
        }

        // Filter by size (if provided)
        if ($request->filled('sizes')) {
            $sizes = $request->input('sizes');
        
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
            if ($request->sort_name === 'a_z') {
                $products->orderBy('name', 'asc');
            } elseif ($request->sort_name === 'z_a') {
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

   public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:products,name',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required',
                'new_brand' => $request->brand_id === '__new__' ? 'required|string|max:255' : 'nullable|string|max:255',
                'sizes' => 'required|array',
                'sizes.*' => 'string|max:10',
                'images' => 'required|array',
                'images.*' => 'image',
            ]);

            if ($validated['brand_id'] === '__new__') {
                $existingBrand = Brand::whereRaw('LOWER(brand_name) = ?', [strtolower($validated['new_brand'])])->first();

                if ($existingBrand) {
                    $brandId = $existingBrand->id;
                } else {
                    $newBrand = Brand::create(['brand_name' => $validated['new_brand']]);
                    $brandId = $newBrand->id;
                }
            } else {
                $brandId = $validated['brand_id'];
            }


            $product = Product::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'category_id' => $validated['category_id'],
                'brand_id' => $brandId
            ]);

            foreach ($validated['sizes'] as $size) {
                $product->variants()->create(['size' => $size]);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('/product_images', 'public');
                    $product->images()->create([
                        'image_path' => 'storage/' . $path,
                        'is_cover' => $index === 0,
                    ]);
                }
            }

            // Detect if it's AJAX or standard request
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Product uploaded successfully!'], 200);
            }

            return redirect()->back()->with('success', 'Product uploaded successfully!');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.addProduct', [
            'categories' => $categories,
            'brands' => $brands,
            'active' => 'addProduct',
        ]);
    }


}