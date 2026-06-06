<?php

namespace App\Http\Controllers\Customer\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function product(Product $product)
    {
        // TO-DO Related Post
        $relatedPost = Product::get()->take(10);
        return view('customer.market.product.product' , ['product' => $product , 'relatedPost' => $relatedPost]);
    }

    public function addComment()
    {
        //
    }
}
