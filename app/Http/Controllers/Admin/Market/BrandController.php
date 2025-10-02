<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\BrandRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::simplePaginate(10);
        return view('admin.market.brand.index' , compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request , ImageService $imageService)
    {
        DB::beginTransaction();
        $validated = $request->validated();
        try {
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brands');
                $result = $imageService->createIndexAndSave($request->file('image'));
                if (! $result) {
                    return redirect()->back()->with('swal-error' , 'مشکلی در آپلود عکس بوجود آمده است');
                }
                $validated['image'] = $result;
            }

            $validated['slug'] = Str::slug($validated['original_name'] . "-" . strtolower(Str::random(5)));
            Brand::create($validated);
            DB::commit();
            return redirect()->route('admin.market.brand.index')
                ->with('swal-success' , "برند شما با موفقیت ایجاد شد". $validated['persian_name']);
        } catch (\Exception $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Exception: " . $errorID . " " . $e->getMessage());
            return redirect()->back()->with('swal-error' , 'مشکلی در ذخیره اطلاعات پیش آمده است' . $errorID);
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
    public function edit(Brand $brand)
    {
        return view('admin.market.brand.edit' , compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand , ImageService $imageService)
    {
        DB::beginTransaction();
        $validated = $request->validated();
        try {
            if ($request->hasFile('image')) {
                if (!empty($brand->image)) {
                    $imageService->deleteDirectoryAndFiles($brand->image['directory']);
                }
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brands');
                $result = $imageService->createIndexAndSave($request->file('image'));
                if (! $result) {
                    return redirect()->back()->with('swal-error' , "مشکلی در آپلود عکس پیش آمده است");
                }
                $validated['image'] = $result;
            } else {
                if ($request->has('currentImage') && !empty($request->input('currentImage'))) {
                    $image = $brand->image;
                    $image['currentImage'] = $request->input('currentImage');
                    $validated['image'] = $image;
                }
            }
            $brand->update($validated);
            DB::commit();
            return redirect()->route('admin.market.brand.index')
                ->with('swal-success' , 'برند مورد نظر با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Exception: " . $errorID . " " . $e->getMessage());
            return redirect()->back()->with('swal-error' , 'مشکلی در ذخیره اطلاعات پیش آمده است' . $errorID);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        DB::beginTransaction();
        try {
            $brand->delete();
            DB::commit();
            return redirect()->route('admin.market.brand.index')
                ->with('swal-success' , 'برند مورد نظر با موفقیت حذف شد');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Exception: " . $errorID . " " . $e->getMessage());
            return redirect()->route('admin.market.brand.index')
                ->with('swal-error', 'مشکلی در حذف برند بوجود آمده است' . $errorID);
        }
    }

    public function status(Brand $brand)
    {
        $brand->status = $brand->status == 1 ? 0 : 1;
        $result = $brand->save();
        if ($result) {
            if ($brand->status == 1) {
                return response()->json([
                    "status" => true,
                    "checked" => true,
                ]);
            } else {
                return response()->json([
                    "status" => true,
                    "checked" => false,
                ]);
            }
        } else {
            return response()->json([
                "status" => false,
            ]);
        }
    }
}
