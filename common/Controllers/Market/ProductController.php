<?php

namespace Common\Controllers\Market;

use App\Http\Controllers\Controller;
use App\Models\Content\Comment;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{

    public function product(Product $product)
    {
        // TO-DO Related Post
        $relatedProducts = Product::get()->take(10);
        return view('customer.market.product.product' , ['product' => $product , 'relatedProducts' => $relatedProducts]);
    }

    public function addComment(Product $product , Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string|min:5|max:255',
        ], [
            'comment.required' => 'متن خود را وارد کنید',
            'comment.string' => 'نوع متن اشتباه است',
            'comment.max' => 'مقدار ورودی نمی تواند بیش از ۲۵۵ کاراکتر باشد',
            'comment.min' => 'مقدار ورودی نمی تواند کمتر از ۵ کاراکتر باشد'
        ]);
        $body = str_replace(PHP_EOL , '</br>' , $request->comment);
        $author = Auth::user()->id;
        $product = $product->id;
        $commentable = Product::class;
        Comment::create([
            'body' => $body,
            'author_id' => $author,
            'commentable_type' => $commentable,
            'commentable_id' => $product,
            'approved' => 0,
            'status' => 0,
            'seen' => 0
        ]);
        return back()->with('swal-success' , 'نظر شما ثبت شد. بعد از تایید مدیریت در سایت قرار داده خواهد شد.');
    }
}
