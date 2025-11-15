<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AddToStorageRequest;
use App\Models\Market\Product;
use App\Models\Market\ShopStorage;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy("created_at" , "desc")
        ->select("id" ,"name" , "image" , "sold_out" , "frozen_number" , "marketable_number")
        ->simplePaginate(10);
        return view('admin.market.store.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addToStore(Product $product)
    {
        return view('admin.market.store.addToStore' , compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product ,AddToStorageRequest $request)
    {
        $validated = $request->validated();

        try {
            $storageResult = ShopStorage::on('sqlite')->create([
                "receiver" => $validated["receiver"],
                "deliverer" => $validated["deliverer"],
                "description" => $validated["description"],
                "product_id" => $product->id
            ]);
            $product->marketable_number += $validated["marketable_number"];
            $productResult = $product->save();
            return redirect()->route('admin.market.store.index')
                ->with('swal-success', 'موجودی مورد نظر با موفیت اضافه شد');
        } catch (\Exception $e) {
            return redirect()->back()->with('swal-error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.market.store.edit' , compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, Request $request)
    {
        $request->validate([
            "marketable_number" => "required|numeric|max:10000",
        ], [
            "marketable_number.required" => "تعداد موجودی فروش اجباری می باشد",
            "marketable_number.numeric" => "تعداد موجودی فروش باید عدد باشد",
            "marketable_number.max" => "تعداد موجودی فروش بیشتر از 10000 تا نمی تواند باشد"
        ]);

        try {
            $product->marketable_number = $request->marketable_number;
            $productResult = $product->save();
            return redirect()->route('admin.market.store.index')
                ->with('swal-success', 'موجودی فروش شما با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return redirect()->route('admin.market.store.index')
                ->with('swal-error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
