<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $recommendedProducts = Product::with('coverImage')->inRandomOrder()->take(4)->get();

        return view('home', [
            'recommendedProducts' => $recommendedProducts
        ]);
    }
}
