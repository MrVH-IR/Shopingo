<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{


    public function index(Product $product)
    {
        return view('admin.market.product.color.index' , compact('product'));
    }

    public function create(Product $product)
    {
        return view('admin.market.product.color.create' , compact('product'));
    }

    public function store(Request $request , Product $product)
    {
        $validatedData = $request->validate([
            "color_name" => "required|string|max:100|regex:/^[\p{L}\p{N}\!?-_.\;:]+$/u",
            "price_increase" => "required|numeric",
        ]);

        $validatedData['product_id'] = $product->id;
        ProductColor::create($validatedData);
        return redirect()->route('admin.market.color.index', $product->id)->with('swal-success', 'رنگ مورد نظر با موفیت ساخته شد');
    }

    public function destroy(Product $product , ProductColor $color)
    {
        $result = $color->delete();
        return redirect()->route('admin.market.color.index', $product->id)
            ->with('swal-success' , 'رنگ مورد نظر با موفقیت حذف شد');
    }
}
