<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Guarantee;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class GuaranteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        return view('admin.market.product.guarantee.index' , compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.market.product.guarantee.create' , compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product , Request $request)
    {
        $validated = $this->validated($request);
        Guarantee::create([
            'name' => $validated['name'],
            'product_id' => $product->id,
            'price_increase' => $validated['price_increase'],
            'status' => $validated['status'],
        ]);
        return redirect()->route('admin.market.guarantee.index', $product->id)
            ->with('swal-success' , 'گارانتی شما با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, Guarantee $guarantee)
    {
        $guarantee->where('product_id', $product->id)->delete();
        return redirect()
            ->route('admin.market.guarantee.index' , $product->id)
            ->with('swal-success' , 'گارانتی با موفقیت حذف شد');
    }

    private function validated($request)
    {
        return $request->validate([
            "name" => "required|string|max:200|min:3|regex:/^[\pL\pN\s\-\_.:?$!@#%^&*() ]+$/u",
            "price_increase" => "required|numeric|min:0",
            "status" => "required|in:0,1",
        ], [
            "name.required" => "لطفا نام گارانتی را وارد کنید",
            "name.string" => "نام گارانتی باید متنی باشد",
            "name.max" => "نام گارانتی نباید بیشتر از ۲۰۰ کاراکتر باشد",
            "name.min" => "نام گارانتی باید حداقل ۳ کاراکتر باشد",
            "name.regex" => "نام گارانتی شامل کاراکترهای غیرمجاز است",

            "price_increase.required" => "مقدار افزایش قیمت الزامی است",
            "price_increase.numeric" => "مقدار افزایش قیمت باید عدد باشد",
            "price_increase.min" => "مقدار افزایش قیمت نمی‌تواند کمتر از ۰ باشد",

            "status.required" => "وضعیت الزامی است",
            "status.in" => "وضعیت باید فعال یا غیرفعال باشد",
        ]);
    }
}
