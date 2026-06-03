<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\BannerRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Banner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at' , 'desc')->simplePaginate(10);
        return view('admin.content.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request , ImageService $imageService)
    {
        try {
            $validated = $request->validated();
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banners');
                $result = $imageService->createIndexAndSave($request->file('image'));
                if ($result === false) return redirect()->route('admin.content.banner.create')->with('swal-error' , 'مشکلی در آپلود عکس پیش آمده است');

                $validated['image'] = $result;
            }
            $validated['author_id'] = 1;
            Banner::create($validated);
            DB::commit();
            return redirect()->route('admin.content.banner.index')->with('swal-success' , 'بنر شما با موفقیت ساخته شد');
        } catch (Exception | Throwable $e ) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            Log::error("Exception In Banner Store: " . "{$errorID} " .$e->getMessage());
            return redirect()->route('admin.content.banner.index')
                ->with('swal-error' , 'مشکلی در ذخیره درخواست پیش آمده است. شماره ارور: ' . $errorID);
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
    public function edit(Banner $banner)
    {
        return view('admin.content.banner.edit' , compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, Banner $banner , ImageService $imageService)
    {
        try {
            $validated = $request->validated();
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                if (
                    is_array($banner->image) &&
                    isset($banner->image['directory']) &&
                    is_dir($banner->image['directory'])
                ) {
                    $imageService->deleteDirectoryAndFiles($banner->image['directory']);
                }
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banners');
                $result = $imageService->createIndexAndSave($request->file('image'));
                if ($result === false) return redirect()->route('admin.content.banner.create')->with('swal-error' , 'مشکلی در آپلود عکس پیش آمده است');

                $validated['image'] = $result;
            } else {
                if ($request->input('currentImage') !== null && !empty($banner->image)) {
                    $image = $banner->image;
                    $image['currentImage'] = $request->input('currentImage');
                    $validated['image'] = $image;
                }
            }
            $banner->update($validated);
            DB::commit();
            return redirect()->route('admin.content.banner.index')->with('swal-success' , 'بنر شما با موفقیت ساخته شد');
        } catch (Exception $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            Log::error("Exception In Banner Update: " . "{$errorID} " .$e->getMessage());
            return redirect()->route('admin.content.banner.index')
                ->with('swal-error' , 'مشکلی در ذخیره درخواست پیش آمده است. شماره ارور: ' . $errorID);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.content.banner.index')
            ->with('swal-success' , 'بنر مورد نظر پاک شد');
    }

    public function status(Banner $banner)
    {
        $banner->status = $banner->status == 1 ? 0 : 1;
        $result = $banner->save();
        if ($result) {
            if ($banner->status == 1) {
                return response()->json([
                    "status" => true,
                    "checked" => true
                ]);
            } else {
                return response()->json([
                    "status" => true,
                    "checked" => false
                ]);
            }
        } else {
            return response()->json([
                "status" => false,
            ]);
        }
    }
}
