<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\FAQRequest;
use App\Models\Content\FAQ;
use Dflydev\DotAccessData\Exception\DataException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = FAQ::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.content.faq.index' , compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FAQRequest $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();
            $validated['slug'] = Str::slug($validated['question']) . '-' . strtolower(Str::random(5));
            $result = FAQ::create($validated);
            DB::commit();
            return redirect()->route('admin.content.faq.index')->with('swal-success' , 'سوال شما با موفقیت ساخت شد');
        } catch (QueryException $e) {
            $errorID = now()->format("YmdHis") . rand(1000 , 9999);
            DB::rollBack();
            \Log::error("QueryException : [$errorID]" . $e->getMessage());
            return redirect()
                ->route('admin.content.faq.create')
                ->with('swal-error' , 'خطایی در کوئری بوجود آمده است' . $errorID)
                ->withInput();
        } catch (DataException $e) {
            $errorID = now()->format("YmdHis") . rand(1000 , 9999);
            DB::rollBack();
            \Log::error("DataException : [$errorID]" . $e->getMessage());
            return redirect()
                ->route('admin.content.faq.create')
                ->with('swal-error' , 'خطایی در دیتابیس بوجود آمده است' . $errorID)
                ->withInput();
        } catch (ValidationException $e) {
            $errorID = now()->format("YmdHis") . rand(1000 , 9999);
            \Log::error("ValidationException : [$errorID]" . $e->getMessage());
            DB::rollback();
            return redirect()
                ->route('admin.content.faq.create')
                ->with('swal-error' , 'حطایی در اعتبار سنجی بوجود آمده است' . $errorID)
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
    public function edit(FAQ $faq)
    {
        return view('admin.content.faq.edit' , compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FAQRequest $request, FAQ $faq)
    {
        DB::beginTransaction();

        try {
            $faq->update($request->validated());
            DB::commit();
            return redirect()
                ->route('admin.content.faq.index')
                ->with('swal-success' , 'سوال مورد نظر با موفقیت تغییر یافت');
        } catch (\Throwable $th) {
            $errorID = now()->format("YmdHis") . rand(1000 , 9999);
            DB::rollBack();
            \Log::error("Exception : [$errorID]" . $th->getMessage());
            return redirect()->back()->with('swal-error' , 'خطای داخلی بوجود آمده است');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $faq)
    {
        try {
            $faq->delete();
            return redirect()
                ->route('admin.content.faq.index')
                ->with('swal-success', 'سوال مورد نظر با موفقیت حذف شد');
        } catch (QueryException $e) {
            \Log::error('QueryException', ['error' => $e->getMessage()]);
            return redirect()
                ->back()
                ->with('swal-error', 'خطا در ذخیره‌سازی اطلاعات در دیتابیس: ' . $e->getMessage())
                ->withInput();
        } catch (ValidationException $e) {
            $errorID = now()->format('YmdHis') . rand(100, 9999);
            \Log::error("ValidationException: [$errorID]", ['error' => $e->getMessage()]);
            return redirect()
                ->back()
                ->with('swal-error' , 'خطا در Validate کردن پیش آمده است');
        }
    }

    public function status(FAQ $faq)
    {
        return $this->changeStatus($faq);
    }
}
