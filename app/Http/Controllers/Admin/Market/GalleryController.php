<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Product;
use App\Models\Market\ProductImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        return view('admin.market.product.gallery.index' , compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.market.product.gallery.create' , compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Product $product , ImageService $imageService)
    {
        $validatedData = $request->validate([
            "image" => "required|mimes:jpeg,jpg,png,svg,webp|max:2048"
        ]);

        $validatedData['product_id'] = $product->id;
        if ($request->hasfile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product_gallery');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (! $result) {
                return redirect()->back()->with('swal-error' , 'مشکلی در آپلود عکس پیش آمده است');
            }
            $validatedData['image'] = $result;
        }
        ProductImage::create($validatedData);
        return redirect()->route('admin.market.gallery.index' , $product->id)->with('swal-success' , 'عکس شما با موفقیت به گالری اضافه شد');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product , ProductImage $productImage)
    {
        $productImage->delete();
        return redirect()->route('admin.market.gallery.index' , $product->id)->with('swal-success' , 'رکورد با موفیت حذف شد');
    }

    public function changeSize(ProductImage $productImage, Request $request)
    {
        if ($request->has('size')) {
            $size = $request->get('size');

            // Validate size
            if (!in_array($size, ['small', 'medium', 'large'])) {
                return response()->json(['error' => 'Invalid size'], 400);
            }

            // Get current image data (as array) thanks to `$casts`
            $imageData = $productImage->image;
            $imageData['currentImage'] = $size;  // Update selected size

            // Save updated data
            $productImage->image = $imageData;
            $productImage->save();

            return response()->json([
                'message' => 'Size updated!',
                'currentImage' => $size
            ]);
        }

        return response()->json([
            'currentImage' => $productImage->image['currentImage']
        ]);
    }
}
