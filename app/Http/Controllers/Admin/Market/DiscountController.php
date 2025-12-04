<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Models\Market\AmazingSale;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class DiscountController extends Controller
{

    public function copan()
    {
        return view('admin.market.discount.copan');
    }

    public function copanCreate()
    {
        return view('admin.market.discount.copan-create');
    }

    public function commonDiscount()
    {
        $commonDiscounts = CommonDiscount::simplePaginate(10);
        return view('admin.market.discount.common' , compact('commonDiscounts'));
    }

    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common-create');
    }

    public function commonDiscountStore()
    {
        //
    }

    public function commonDiscountEdit()
    {
        //
    }

    public function commonDiscountUpdate()
    {
        //
    }

    public function commonDiscountDestroy()
    {
        //
    }

    public function amazingSale()
    {
        $amazingSales = AmazingSale::simplePaginate(10);
        return view('admin.market.discount.amazing' , compact('amazingSales'));
    }

    public function amazingSaleCreate()
    {
        $products = Product::all('id' , 'name');
        return view('admin.market.discount.amazing-create' , compact('products'));
    }

    public function amazingSaleStore(AmazingSaleRequest $request)
    {
        $validated = $request->validated();
        $validated['start_at'] = Jalalian::fromFormat('Y/m/d H:i:s' , $validated['start_at'])->toCarbon()->format('Y-m-d H:i:s');
        $validated['end_at'] = Jalalian::fromFormat('Y/m/d H:i:s' , $validated['end_at'])->toCarbon()->format('Y-m-d H:i:s');
        $amazingSale = AmazingSale::create($validated);
        return redirect()
            ->route('admin.market.discount.amazingSale')
            ->with('swal-success' , "تخفیف شگفت انگیر شما با موفقیت ایجاد شد. تاریخ شروع از {$validated['start_at']} تا {$validated['end_at']} میباشد");
    }

    public function amazingSaleEdit(AmazingSale $amazingSale)
    {
        $products = Product::all('id' , 'name');
        return view('admin.market.discount.amazing-edit' , compact('amazingSale' , 'products'));
    }

    public function amazingSaleUpdate(AmazingSaleRequest $request, AmazingSale $amazingSale)
    {
        $validated = $request->validated();
        $validated['start_at'] = Jalalian::fromFormat('Y/m/d H:i:s' , $validated['start_at'])->toCarbon()->format('Y-m-d H:i:s');
        $validated['end_at'] = Jalalian::fromFormat('Y/m/d H:i:s' , $validated['end_at'])->toCarbon()->format('Y-m-d H:i:s');
        $amazingSale->update($validated);
        return redirect()->route('admin.market.discount.amazingSale')
            ->with('swal-success' , "تخفیف شگفت انگیر شما با موفقیت ویرایش شد. تاریخ شروع از {$validated['start_at']} تا {$validated['end_at']} میباشد");
    }

    public function amazingSaleDestroy(AmazingSale $amazingSale)
    {
        $amazingSale->delete();
        return redirect()->route('admin.market.discount.amazingSale')
            ->with('swal-success' , 'فروش شگفت انگیز شما با موفقیت حذف شد');
    }
}
