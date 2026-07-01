<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\SMSRequest;
use App\Http\Services\Time\TimeService;
use App\Models\Notify\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sms = SMS::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.notification.sms.index' , compact('sms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notification.sms.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(SMSRequest $request , SMS $sms , TimeService $timeService)
    {
        list($jalaliDate , $time) = explode(' ' , $request->published_at);
        $jy = substr($request->published_at,0,4);
        $jm = substr($request->published_at,5,2);
        $jd = substr($request->published_at,8,2);
        $published_at = $timeService->jalali_to_gregorian($jy, $jm , $jd);
        $gy = $published_at[0];
        $gm = str_pad($published_at[1], 2, "0", STR_PAD_LEFT);
        $gd = str_pad($published_at[2], 2, "0", STR_PAD_LEFT);

        $published_at = "$gy-$gm-$gd " . $time;
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['published_at'] = $published_at;
            $result = SMS::create($validated);
            DB::commit();
            return redirect()
                ->route('admin.sms.index')
                ->with('swal-success' , 'پیام شما با موفقیت ساخته شد')
                ->withInput();
        } catch (\Throwable $th) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Throwable Exception: [$errorID]" . $th->getMessage());
            return redirect()
                ->back()
                ->with('swal-error' ,"خطای داخلی:". $errorID)
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
    public function edit(SMS $sms)
    {
        return view('admin.notification.sms.edit' , compact('sms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SMSRequest $request , SMS $sms , TimeService $timeService)
    {
        list($jalaliDate, $time) = explode(' ', $request->published_at);

        list($jy, $jm, $jd) = explode('/', $jalaliDate);

        $published_at = $timeService->jalali_to_gregorian($jy, $jm, $jd);

        $gy = $published_at[0];
        $gm = str_pad($published_at[1], 2, "0", STR_PAD_LEFT);
        $gd = str_pad($published_at[2], 2, "0", STR_PAD_LEFT);

        $published_at = "$gy-$gm-$gd $time";
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['published_at'] = $published_at;
            $sms->update($validated);
            DB::commit();
            return redirect()
                ->route('admin.sms.index')
                ->with('swal-success' , 'پیام شما با تغییر یافت')
                ->withInput();
        } catch (\Throwable $th) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Throwable Exception: [$errorID]" . $th->getMessage());
            return redirect()
                ->back()
                ->with('swal-error' ,"خطای داخلی:". $errorID)
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SMS $sms)
    {
        DB::beginTransaction();

        try {
            $sms->delete();
            DB::commit();

            return redirect()
                ->route('admin.sms.index')
                ->with('swal-success' , "پیام شما با موفقت پاک شد");
        } catch (\Throwable $th) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Throwable Exception: [$errorID]" . $th->getMessage());
            return redirect()
                ->back()
                ->with('swal-error' , 'خطای داخلی' . $errorID)
                ->withInput();
        }
    }

    public function status(SMS $sms)
    {
        return $this->changeStatus($sms);
    }
}
