<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;
use App\Models\Content\Menu;
use Couchbase\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('created_at' , 'desc')->simplePaginate(10);
        return view('admin.content.menu.index' , compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::where('parent_id' , null)->orderBy('created_at' , 'desc')->get();
        return view('admin.content.menu.create' , compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();
            $validated['url'] = trim(
                preg_replace('/-+/', '-',
                    preg_replace('/[^a-zA-Z0-9]+/', '-',
                        strtolower($request->url)
                    )
                ), '-'
            );
            Menu::create($validated);
            DB::commit();
            return redirect()
                ->route('admin.content.menu.index')
                ->with('swal-success' , 'منو با موفقیت ساخته شد');
        } catch (QueryException $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error("QueryException: [$errorID]" . $e->getMessage());
            return redirect()
                ->back()
                ->with('swal-error', 'خطا در دیتابیس !' . $errorID)
                ->withInput();
        } catch (ValidationException $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error("QueryException: [$errorID]" . $e->getMessage());
            return redirect()
                ->back()
                ->with('swal-error', 'خطا در اعتبار سنجی !' . $errorID)
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
    public function edit(Menu $menu)
    {
        $parent_menus = Menu::where('parent_id' , null)->get()->except($menu->id);
        return view('admin.content.menu.edit' , compact('menu' , 'parent_menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();
            $validated['url'] = trim(
                preg_replace('/-+/', '-',
                    preg_replace('/[^a-zA-Z0-9]+/', '-',
                        strtolower($request->url)
                    )
                ), '-'
            );
            $menu->update($validated);
            DB::commit();
            return redirect()
                ->route('admin.content.menu.index')
                ->with('swal-success' , 'منو با آپدیت شد');
        } catch (QueryException $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error("QueryException: [$errorID]" . $e->getMessage());
            return redirect()
                ->back()
                ->with('swal-error', 'خطا در دیتابیس !' . $errorID)
                ->withInput();
        } catch (ValidationException $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error("QueryException: [$errorID]" . $e->getMessage());
            return redirect()
                ->back()
                ->with('swal-error', 'خطا در اعتبار سنجی !' . $errorID)
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        DB::beginTransaction();
        try {
            $menu->delete();
            DB::commit();
            return redirect()->back()->with('swal-success', 'منو با موفقیت حذف شد');
        } catch (QueryException $e) {
            DB::rollBack();
            $errorID = now()->format("YmdHis") . rand(1000, 9999);
            \Log::error("QueryException: [$errorID]" . $e->getMessage());
            // Handle foreign key constraint, etc.
            return redirect()->back()->with('swal-error', 'حذف منو با خطا مواجه شد' . $errorID);
        }
    }

    public function status(Menu $menu)
    {
        $menu->status = $menu->status == 0 ? 1 : 0;
        $result = $menu->save();
        if ($result) {
            if ($menu->status == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false,
                ]);
            } else {
                if ($menu->status == 1) {
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
