<?php

namespace Common\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;

class ProductController extends BaseController
{

    public function product(Product $product)
    {
        // TO-DO Related Post
        $relatedProducts = Product::get()->take(10);
        return view('customer.market.product.product' , ['product' => $product , 'relatedProducts' => $relatedProducts]);
    }

    public function addComment()
    {
        //
    }
}
