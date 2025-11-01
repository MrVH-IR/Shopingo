<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PostCategory;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\ProductMeta;
use Exception;
use Fiber;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use function PHPUnit\Framework\callback;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::simplePaginate(10);
        return view('admin.market.product.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::pluck('name' , 'id')->all();
        $brands = Brand::select('original_name' , 'persian_name' , 'id')->get();
        return view('admin.market.product.create' , compact('productCategories' , 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request , ImageService $imageService)
    {
        $validatedData = $request->validated();
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'products');
                $result = $imageService->createIndexAndSave($request->file('image'));
                if ($result === false)
                {
                    return redirect()
                        ->route('admin.content.category.index')
                        ->with('swal-error' , 'مشکلی در آپلود عکس پیش آمده است');
                }
            }
            $realTime = $validatedData['published_at'];
            $validatedData['published_at'] = date("Y-m-d", strtotime( (int) $realTime));
            $validatedData["image"] = $result;
            $validatedData["slug"] = Str::slug($validatedData["name"] . "-" . Str::random(5));
            $product = Product::create($validatedData);
            if(!empty($validatedData['meta_key']) && !empty($validatedData['meta_value'])){
                $metas = array_unique(array_combine($request->meta_key , $request->meta_value));
                foreach($metas as $key => $value){
                    $meta = ProductMeta::create([
                        'meta_key' => $key,
                        'meta_value' => $value,
                        'product_id' => $product->id
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.market.product.index')->with('swal-success' , 'محصول شما با موفقیت ساخته شد');
        } catch (HttpResponseException | Exception | ValidationException | ModelNotFoundException | InvalidArgumentException $e) {
            DB::rollBack();
            $errorID = now()->format("YmdHis") . rand(1000 , 9999);
            Log::error("Exception {$errorID} " . $e->getMessage());
            return redirect()->route('admin.market.product.create')->with('swal-error' , 'مشکی در ذخیره داده پیش آمده است' . ' ' . $errorID);
        } finally {
            if (isset($e) && $result) {
                $imageService->deleteDirectoryAndFiles($result);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $productCategories = ProductCategory::pluck('name' , 'id')->all();
        $brands = Brand::select('original_name' , 'persian_name' , 'id')->get();
        return view('admin.market.product.edit' , compact('product' , 'productCategories' , 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product , ImageService $imageService)
    {
        $validatedData = $request->validated();
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                if ($product->image) {
                    $imageService->deleteDirectoryAndFiles($product->image['directory']);
                }
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'products');
                $result = $imageService->createIndexAndSave($request->file('image'));
                $validatedData["image"] = $result;
                if ($result === false)
                {
                    return redirect()
                        ->route('admin.content.category.index')
                        ->with('swal-error' , 'مشکلی در آپلود عکس پیش آمده است');
                }
            } else {
                if (isset($request->currentImage) && !empty($product->image)) {
                    $image = $product->image;
                    $image['currentImage'] = $request->currentImage;
                    $validatedData["image"] = $image;
                }
            }
            $realTime = $validatedData['published_at'];
            $validatedData['published_at'] = date("Y-m-d", strtotime( (int) $realTime));
            $validatedData["slug"] = Str::slug($validatedData["name"] . "-" . Str::random(5));
            $product->update($validatedData);
            $meta_keys = $request->meta_key;
            $meta_values = $request->meta_value;
            $meta_ids = array_keys($meta_keys);
            $metas = array_map(function ($meta_id , $meta_key , $meta_value) {
                return array_combine([
                    "meta_id" , "meta_key" , "meta_value"
                ], [$meta_id , $meta_key , $meta_value]);
            } , $meta_ids , $meta_keys , $meta_values);
            foreach ($metas as $meta) {
                ProductMeta::where('id' , $meta['meta_id'])->update([
                    "meta_key" => $meta['meta_key'],
                    "meta_value" => $meta['meta_value']
                ]);
            }
            DB::commit();
            return redirect()->route('admin.market.product.index')->with('swal-success' , 'محصول شما با موفقیت ویرایش شد');
        } catch (HttpResponseException | Exception | ValidationException | ModelNotFoundException | InvalidArgumentException $e) {
            DB::rollBack();
            $errorID = now()->format("YmdHis") . rand(1000 , 9999);
            Log::error("Exception {$errorID} " . $e->getMessage());
            return redirect()->route('admin.market.product.edit' , $product->id)->with('swal-error' , 'مشکی در ذخیره داده پیش آمده است' . ' ' . $errorID);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.market.product.index')->with('swal-success' , 'محصول شما با موفقیت پاک شد');
    }

    public function status(Product $product)
    {
        $product->status = $product->status == 1 ? 0 : 1;
        $result = $product->save();
        if ($result) {
            if ($product->status == 1) {
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
