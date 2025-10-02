<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\DeliveryRequest;
use App\Models\Market\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::all();
        return view('admin.market.delivery.index' , compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            Delivery::create($validated);
            DB::commit();
            return redirect()->route('admin.market.delivery.index')
                ->with('swal-success' , 'روش ارسال جدید با موفقیت ایجاد شد');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Exception : $errorID " . $e->getMessage());
            return redirect()->back()->with('swal-error' , "مشکلی در ذخیره روش ارسال بوجود آمده است" . $errorID);
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
    public function edit(Delivery $delivery)
    {
        return view('admin.market.delivery.edit' , compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeliveryRequest $request, Delivery $delivery)
    {
        DB::beginTransaction();
        try {
            $delivery->update($request->all());
            DB::commit();
            return redirect()
                ->route('admin.market.delivery.index')
                ->with('swal-success' , 'روش ارسال با موفقیت ایجاد شد');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Exception : $errorID " . $e->getMessage());
            return redirect()->back()->with('swal-error' , "مشکلی در ویرایش روش ارسال بوجود آمده است" . $errorID);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        DB::beginTransaction();
        try {
            $delivery->delete();
            DB::commit();
            return redirect()->route('admin.market.delivery.index')
                ->with('swal-success' , 'روش ارسال با موفیت حذف شد');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Exception : $errorID " . $e->getMessage());
            return redirect()->back()->with('swal-error' , 'مشکلی در جذف روش ارسال بوجود آمده است' . $errorID);
        }
    }

    public function status(Delivery $delivery)
    {
        $delivery->status = $delivery->status == 0 ? 1 : 0;
        $result = $delivery->save();
        if ($result) {
            if($delivery->status == 0){
                return response()->json([
                    'status' => true,
                    'checked' => false
                ]);
            } else {
                if ($delivery->status == 1) {
                    return response()->json([
                        'status' => true,
                        'checked' => true
                    ]);
                }
            }
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
