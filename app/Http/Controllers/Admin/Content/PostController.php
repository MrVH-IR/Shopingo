<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostRequest;
use App\Http\Services\Image\ImageService;
use App\Http\Services\Time\TimeService;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->cursorPaginate(10 , '*' , 'page');
        return view('admin.content.post.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postCategories = PostCategory::where('status' , '1')->pluck('name' , 'id');
        return view('admin.content.post.create' , compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request , ImageService $imageService)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();
            $result = null;
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');
                $result = $imageService->createIndexAndSave($request->file('image'));
                if ($result === false) {
                    return redirect()->route('admin.content.post.create')->with('swal-error' , 'مشکلی در آپلود عکس بوجود آمده است');
                }
            }
            $realTime = $request->published_at;
            $validated['published_at'] = date('Y-m-d', strtotime( (int) $realTime));
            $validated['image'] = $result;
            $validated['slug'] = Str::slug($validated['title']) . '-' . strtolower(Str::random(5));
            $validated['author_id'] = 20; // For Now - Test
            $post = Post::create($validated);

            DB::commit();

            return redirect()
                ->route('admin.content.post.index')
                ->with('swal-success', 'پست با موفقیت ساخته شد');
        } catch (ValidationException $e) {
            $errorID = now()->format('YmdHis') . rand(100, 9999);
            \Log::error("ValidationException: [$errorID]" , ['error' => $e->getMessage()]);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('swal-error', 'خطا ! در Validate کردن خطا پیش آمده است ' . $errorID)
                ->withInput();
        } catch (FileException $e) {
            $errorID = now()->format('YmdHis') . rand(100, 9999);
            \Log::error("FileException: [$errorID]", ['error' => $e->getMessage()]);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('swal-error', 'خطا در آپلود یا ذخیره فایل: ' . $errorID)
                ->withInput();
        } catch (QueryException $e) {
            $errorID = now()->format('YmdHis') . rand(100, 9999);
            \Log::error("QueryException: [$errorID]", ['error' => $e->getMessage()]);
            DB::rollBack();
            return redirect()
                ->back()
                ->with('swal-error', 'خطا در ذخیره‌سازی اطلاعات در دیتابیس: ' . $errorID)
                ->withInput();
        } catch (\Exception $e) {
            $errorID = now()->format('YmdHis') . rand(100, 9999);
            \Log::error("Exception: [$errorID]", ['exception' => $e->getMessage()]);
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
    public function edit(Post $post)
    {
        $postCategories = PostCategory::all();
        $object = new TimeService();
        $postCategory = $post->category;
        $gy = substr($post->published_at, 0, 4);
        $gm = substr($post->published_at, 5, 2);
        $gd = substr($post->published_at, 8, 2);
        $jalaliDateArr = $object->gregorian_to_jalali($gy, $gm, $gd);
        $jalaliDate = sprintf('%04d/%02d/%02d', $jalaliDateArr[0], $jalaliDateArr[1], $jalaliDateArr[2]);

        return view('admin.content.post.edit' , compact('postCategory' , 'post' , 'postCategories' , 'jalaliDate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, ImageService $imageService , Post $post)
    {
        $validated = $request->validated();
        $result = null;
        if ($request->hasFile('image')) {
            if(!empty($post->image)){
                $imageService->deleteDirectoryAndFiles($post->image['directory']);
            }

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false) {
                return redirect()->route('admin.content.post.edit' , $post->id)
                    -with('swal-error' , "مشکلی در آپلود عکس پیش آمده است");
            }

            $validated['image'] = $result;
        } else {
            if ($request->has('currentImage') && !empty($post->image)) {
                $image = $post->image;
                $image['currentImage'] = $request->input('currentImage');
                $validated['image'] = $image;
            }
        }
        $validated['published_at'] = date('Y-m-d', strtotime( (int) $request->input('published_at')));
        $post->update($validated);
        if (!$post) {
            return redirect()->route('admin.content.post.edit' , $post->id)
                ->with('swal-error' , 'مشکلی برای ذخیره تغییرات پیش آمده است');
        }
        return redirect()
            ->route('admin.content.post.index')
            ->with('swal-success' , 'پست با موفقیت ذخیره شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return redirect()->route('admin.content.post.index')->with('swal-success' , 'پست با موفقیت جذف شد');
        } catch (\Exception $e) {
            $errorID = now()->format('YmdHis') . rand(100, 9999);
            \Log::error("Exception: [$errorID]" , ['error' => $e->getMessage()]);
        }
    }

    /**
     * @param Post $post
     * @return JsonResponse|null
     */
    public function status(Post $post)
    {
        $post->status = $post->status == 0 ? 1 : 0;
        $result = $post->save();
        if ($result) {
            if ($post->status == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false,
                ]);
            } else {
                if ($post->status == 1) {
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
        return null;
    }

    public function commentable(Post $post)
    {
        $post->commentable = $post->commentable == 0 ? 1 : 0;
        $result = $post->save();
        if ($result) {
            if ($post->commentable == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false,
                ]);
            } else {
                if ($post->commentable == 1) {
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
        return null;
    }
}
