<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Models\Content\PostCategory;
use Illuminate\Support\Str;

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
     */
    public function store(PostCategoryRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $validatedData['slug'] = Str::slug($validatedData['name']) . '-' . strtolower(Str::random(5));
            $path = '/home/mrvh/Personal/Projects/Laravel/TutorialV2/admin/images/postcategories';
            $fileName = uniqid() . '.' . $validatedData['image']->getClientOriginalExtension();
            $validatedData['image']->move($path, $fileName);
            $validatedData['image'] = '/postcategories/' . $fileName;
            $postCategory = PostCategory::create($validatedData);
            return redirect()
                ->route('admin.content.category.index')
                ->with('swal-success' , 'دسته بندی با موفقیت ایجاد شد');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
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
    public function update(PostCategoryRequest $request , PostCategory $postCategory)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $path = '/home/mrvh/Personal/Projects/Laravel/TutorialV2/admin/images/postcategories';
            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $validatedData['image'] = '/postcategories/' . $fileName;
        }
        $postCategory->update($validatedData);
        return redirect()->route('admin.content.category.index')->with('swal-success' , 'دسته بندی شما با موفقیت ویرایش شد');
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
        } catch (\Exception $e) {
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

    public function test($id) {
        return response()->json([
            "status" => 200,
            "message" => "Test Message",
        ]);
    }
}
