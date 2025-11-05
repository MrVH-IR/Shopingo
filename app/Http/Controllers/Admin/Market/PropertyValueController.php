<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryValueRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryValue;
use Illuminate\Http\Request;

class PropertyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.index', compact('categoryAttribute'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.create', compact('categoryAttribute'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryValueRequest $request ,CategoryAttribute $categoryAttribute)
    {
        $validated = $request->validated();
        $validated['value'] = json_encode(['value' => $validated['value'] , 'price_increase' => $validated['price_increase']] , JSON_UNESCAPED_UNICODE);
        $validated['category_attribute_id'] = $categoryAttribute->id;
        $value = CategoryValue::create($validated);
        return redirect()->route('admin.market.value.index' , $categoryAttribute->id)
            ->with('swal-success', "مقدار فرم کالای جدید شما با موفقیت اضافه شد");
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
    public function edit(CategoryAttribute $categoryAttribute , CategoryValue $value)
    {
        return view('admin.market.property.value.edit', compact('categoryAttribute' , 'value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryValueRequest $request, CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
        $validated = $request->validated();
        $validated['value'] = json_encode(['value' => $validated['value'] , 'price_increase' => $validated['price_increase']] , JSON_UNESCAPED_UNICODE);
        $validated['category_attribute_id'] = $categoryAttribute->id;
        $value->update($validated);
        return redirect()->route('admin.market.value.index' , $categoryAttribute->id)
            ->with('swal-success', "مقدار فرم کالای شما با موفقیت ویرایش شد");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
        $value->delete();
        return redirect()->route('admin.market.value.index' , $categoryAttribute->id)
            ->with('swal-success', "مقدار فرم کالای شما با موفقیت حذف شد");
    }
}
