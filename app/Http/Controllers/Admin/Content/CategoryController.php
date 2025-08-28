<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PostCategory;
// use Facades\App\Repository\PostCategory;
use Exception;
use Illuminate\Database\QueryException;
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
        $postCategories = PostCategory::orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->cursorPaginate(10 , '*' , 'page');
        /**
         * Only If You Need It Cached Uncomment This Below
         * App\Repository\PostCategory
         */
        // $postCategories = PostCategory::all('created_at' , 'desc');
        return view('admin.content.category.index' , compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.category.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws Exception
     */
    public function store(PostCategoryRequest $request , ImageService $imageService)
    {

        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            if ($request->hasFile('image'))
            {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
                $result = $imageService->createIndexAndSave($request->file('image'));
                if ($result === false)
                {
                    return redirect()
                        ->route('admin.content.category.index')
                        ->with('swal-error' , 'مشکلی در آپلود عکس پیش آمده است');
                }
            }
            $validatedData['image'] = $result;
            $validatedData['slug'] = Str::slug($validatedData['name']) . '-' . strtolower(Str::random(5));
            $postCategory = PostCategory::create($validatedData);

            DB::commit();

            return redirect()
                ->route('admin.content.category.index')
                ->with('swal-success' , 'دسته بندی با موفقیت ایجاد شد');
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
    public function edit(PostCategory $postCategory)
    {
        return view('admin.content.category.edit' , compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCategoryRequest $request, PostCategory $postCategory, ImageService $imageService)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            if (!empty($postCategory->image)) {
                $imageService->deleteDirectoryAndFiles($postCategory->image['directory']);
            }

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false) {
                return redirect()
                    ->route('admin.content.category.edit')
                    ->with('swal-error', '
                    مشکلی در آپلود عکس پیش آمده است');
            }

            $validatedData['image'] = $result;
        } else {
            if ($request->has('currentImage') && !empty($request->input('currentImage'))) {
                $image = $postCategory->image; // array
                $image['currentImage'] = $request->input('currentImage'); // مقدار جدید
                $validatedData['image'] = $image;
            }
        }

        $postCategory->update($validatedData);

        return redirect()
            ->route('admin.content.category.index')
            ->with('swal-success', 'دسته بندی شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory)
    {
        try {
            $postCategory->delete();

            if (method_exists($postCategory, 'trashed') && $postCategory->trashed()) {
                return redirect()->route('admin.content.category.index')
                    ->with('swal-success' , 'دسته بندی با موفقیت حذف شد');;
            }

            return redirect()->route('admin.content.category.index')
                ->with('swal-success', 'دسته بندی شما با موفقیت حذف شد');
        } catch (Exception $e) {
            return redirect()->route('admin.content.category.index')
                ->with('swal-error', 'خطا در حذف رکورد: ' . $e->getMessage());
        }
    }

    public function status(PostCategory $postCategory)
    {
        $postCategory->status = $postCategory->status == 0 ? 1 : 0;
        $result = $postCategory->save();
        if ($result) {
            if ($postCategory->status == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false,
                ]);
            } else {
                if ($postCategory->status == 1) {
                    return response()->json([
                        'status' => true,
                        'checked' => true,
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
