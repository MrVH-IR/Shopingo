<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\PropertyRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryAttributes = CategoryAttribute::simplePaginate(10);
        return view('admin.market.property.index' , compact('categoryAttributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.property.create' , compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {

        try {
            $validatedData = $request->validated();
            $validatedData["type"] = match ($validatedData["type"]) {
                "text" => 1,
                "select" => 2,
                "checkbox" => 3,
                "radio" => 4,
                "textarea" => 5,
                default => 1,
            };
            $result = CategoryAttribute::create($validatedData);
            return redirect()->route('admin.market.property.index')
                ->with('swal-success', 'فرم کالا با موفقیت ساخته شد' . ' ' . "$result->name");
        } catch (\Exception $e) {
            return redirect()->route('admin.market.property.create')
                ->with('swal-error', 'ساخت فرم کالا با ارور مواجه شد' . ' ' . $e->getMessage());
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
    public function edit(CategoryAttribute $categoryAttribute)
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.property.edit' , compact('categoryAttribute' , 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyRequest $request, CategoryAttribute $categoryAttribute)
    {
        try {
            $validatedData = $request->validated();
            $validatedData["type"] = match ($validatedData["type"]) {
                "text" => 1,
                "select" => 2,
                "checkbox" => 3,
                "radio" => 4,
                "textarea" => 5,
                default => 1,
            };
            $result = $categoryAttribute->update($validatedData);

            if($result) {
                return redirect()->route('admin.market.property.index')
                    ->with('swal-success', 'ویژگی با موفقیت ویرایش شد');
            }

            return redirect()->route('admin.market.property.edit', $categoryAttribute->id)
                ->with('swal-error', 'هیچ تغییری اعمال نشد.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('swal-success', 'ویرایش با خطا مواجه شد');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAttribute $categoryAttribute)
    {
        try {
            $categoryAttribute->delete();
            return redirect()->route('admin.market.property.index')
                ->with('swal-success' , 'ویژگی محصول با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->route('admin.market.property.index')
                ->with('swal-error' , 'حذف ویژگی با مشکل رو به رو شد');
        }
    }
}
