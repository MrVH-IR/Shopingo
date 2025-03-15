<?php

namespace App\Http\Controllers;

use App\Models\HomeProduct;
use App\Models\Product;
// use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $homeProduct = HomeProduct::first();

        $first_div = $homeProduct && $homeProduct->first_div ? Product::where('category_id', $homeProduct->first_div)->get() : [];
        $second_div = $homeProduct && $homeProduct->second_div ? Product::where('category_id', $homeProduct->second_div)->get() : [];
        $third_div = $homeProduct && $homeProduct->third_div ? Product::where('category_id', $homeProduct->third_div)->get() : [];

        return view('index', compact('first_div', 'second_div', 'third_div'));
    }
}
