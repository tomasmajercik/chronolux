<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['variants', 'coverImage', 'category'])->paginate(100);

        return view('admin.editProduct', [
            'active' => 'editProduct',
            'products' => $products,
        ]);
    }
}