<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PageRequest;
use App\Models\Content\Page;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::orderBy('created_at' , 'desc')->simplePaginate(10);
        return view('admin.content.page.index' , compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['slug'] = Str::slug(strtolower($request->title) . '-' . Str::random(5));
            $page = Page::create($validated);
            DB::commit();
            return redirect()->route('admin.content.page.index')->with('swal-success', 'صفحه شما با موفقیت ساخته شد');
        } catch (QueryException $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("QueryException [$errorID]" . $e->getMessage());
            return redirect()->back()->with('swal-error' , 'ارور دیتابیس', $errorID)->withInput();
        } catch (ValidationException $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error("ValidationException [$errorID]" . $e->getMessage());
            return redirect()->back()->with('swal-error', 'ارور اعتبار سنجی' . $errorID)->withInput();
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
    public function destroy(string $id)
    {
        //
    }

    public function status(Page $page)
    {
        $page->status = $page->status ? 0 : 1;

        if ($page->save()) {
            return response()->json([
                'status' => true,
                'checked' => (bool) $page->status,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to update status.',
        ], 500);
    }
}
