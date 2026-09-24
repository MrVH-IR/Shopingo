<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductCategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\ProductCategory;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategories = ProductCategory::query()->paginate(15);
        return view('admin.market.category.index' , compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::where('parent_id' , null)->get();
        return view('admin.market.category.create' , compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request , ImageService $imageService)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();

            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product_categories');
                $result = $imageService->createIndexAndSave($request->file('image'));
                if ($result === false) {
                    return redirect()
                        ->route('admin.market.category.create')
                        ->with('swal-error' , 'مشکلی در آپلود عکس پیش آمده است');
                }
            }
            $validated['image'] = $result;
            $validated['slug'] = Str::slug($validated['name']) . '-' . strtolower(Str::random(5));

            ProductCategory::create($validated);

            DB::commit();

            return redirect()->route('admin.market.category.index')->with('swal-success' , 'دسته بندی شما با موفقیت ساخته شد');
        } catch (ValidationException $e) {
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error('ValidationException', ["$errorID" => $e->getMessage()]);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('swal-error', 'خطا ! در Validate کردن خطا پیش آمده است ' . $errorID)
                ->withInput();
        } catch (FileException $e) {
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error('FileException', ["$errorID" => $e->getMessage()]);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('swal-error', 'خطا در آپلود یا ذخیره فایل: ' . $errorID)
                ->withInput();
        } catch (QueryException $e) {
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error('QueryException', ["$errorID" => $e->getMessage()]);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('swal-error', 'خطا در ذخیره‌سازی اطلاعات در دیتابیس: ' . $errorID)
                ->withInput();
        } catch (\Exception $e) {
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error('Exception', ["$errorID" => $e->getMessage()]);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('swal-error', 'خطای ناشناخته رخ داده است: ' . $errorID)
                ->withInput();
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
    public function edit(ProductCategory $productCategory)
    {
        $parent_categories = ProductCategory::where('parent_id' , null)->get()->except($productCategory->id);
        return view('admin.market.category.edit' , compact('productCategory' , 'parent_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request , ImageService $imageService , ProductCategory $productCategory)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();

            if ($request->hasFile('image')) {
                if(!empty($productCategory->image)){
                    $imageService->deleteDirectoryAndFiles($productCategory->image['directory']);
                }
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product_categories');
                $result = $imageService->createIndexAndSave($request->file('image'));
                if ($result === false) {
                    return redirect()
                        ->route('admin.market.category.create')
                        ->with('swal-error' , 'مشکلی در آپلود عکس پیش آمده است');
                }
                $validated['image'] = $result;
            } else {
                if($request->has('currentImage') && !empty($request->input('currentImage'))){
                    $image = $productCategory->image;
                    $image['currentImage'] = $request->input('currentImage');
                    $validated['image'] = $image;
                }
            }

            $productCategory->update($validated);

            DB::commit();

            return redirect()->route('admin.market.category.index')->with('swal-success' , 'دسته بندی شما با موفقیت آپدیت شد');
        } catch (ValidationException $e) {
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error('ValidationException', ["$errorID" => $e->getMessage()]);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('swal-error', 'خطا ! در Validate کردن خطا پیش آمده است ' . $errorID)
                ->withInput();
        } catch (FileException $e) {
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error('FileException', ["$errorID" => $e->getMessage()]);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('swal-error', 'خطا در آپلود یا ذخیره فایل: ' . $errorID)
                ->withInput();
        } catch (QueryException $e) {
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error('QueryException', ["$errorID" => $e->getMessage()]);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('swal-error', 'خطا در ذخیره‌سازی اطلاعات در دیتابیس: ' . $errorID)
                ->withInput();
        } catch (\Exception $e) {
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error('Exception', ["$errorID" => $e->getMessage()]);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('swal-error', 'خطای ناشناخته رخ داده است: ' . $errorID)
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        try {
            $productCategory->delete();

            if (method_exists($productCategory, 'trashed') && $productCategory->trashed()) {
                return redirect()->route('admin.market.category.index')
                    ->with('swal-success' , 'دسته بندی با موفقیت حذف شد');;
            }

            return redirect()->route('admin.market.category.index')
                ->with('swal-success', 'دسته بندی شما با موفقیت حذف شد');
        } catch (Exception $e) {
            return redirect()->route('admin.market.category.index')
                ->with('swal-error', 'خطا در حذف رکورد: ' . $e->getMessage());
        }
    }
}
