<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\EmailRequest;
use App\Http\Services\File\FileToolsService;
use App\Http\Services\Time\TimeService;
use App\Models\Notify\Email;
use App\Models\Notify\EmailFile;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails = Email::orderBy("created_at", "DESC")
            ->with('files')
            ->paginate(10, ['*'], 'صفحه');
        return view('admin.notification.email.index' , compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notification.email.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmailRequest $request , Email $email , TimeService $timeService , FileToolsService $fileToolsService)
    {
        [$date, $time] = explode(' ', $request->published_at);

        [$year, $month, $day] = explode('/', $date);
        $tempType = $timeService->jalali_to_gregorian($year, $month, $day);

        $published_at = sprintf(
            '%04d-%02d-%02d %s',
            $tempType[0],
            $tempType[1],
            $tempType[2],
            $time
        );

        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['published_at'] = $published_at;
            $mail = Email::create($validated);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $result = $fileToolsService->setFile($file)->saveInStorage();
                    if (! $result) {
                        DB::rollBack();
                        return redirect()
                            ->back()
                            ->with('swal-error' , "مشکلی در آپلود فایل پیش آمده است")
                            ->withInput();
                    }

                    $publicFiles = new EmailFile();
                    $publicFiles->public_mail_id = $mail->id;
                    $publicFiles->file_path = $result['path'];
                    $publicFiles->file_size = $result['size'];
                    $publicFiles->file_type = $result['extension'];
                    $publicFiles->status = 1;
                    $publicFiles->save();
                }
            }

            DB::commit();
            return redirect()
                ->route('admin.email.index')
                ->with('swal-success' , 'ایمیل شما با موفقیت ساخته شد')
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
    public function edit(Email $email)
    {
        return view('admin.notification.email.edit' , compact('email'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailRequest $request, Email $email , TimeService $timeService)
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
            $email->update($validated);
            DB::commit();
            return redirect()
                ->route('admin.email.index')
                ->with('swal-success' , 'ایمیل شما با تغییر یافت')
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
    public function destroy(Email $email)
    {
        DB::beginTransaction();
        try {
            $email->delete();
            DB::commit();
            return redirect()
                ->route('admin.email.index')
                ->with('swal-success' , 'ایمیل مورد نظر با موفقت حدف شد');
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

    public function status(Email $email)
    {
        return $this->changeStatus($email);
    }

    public function viewFile(Email $email)
    {
        $emailFiles = $email->files;
        return view('admin.notification.email.files' , compact('emailFiles' , 'email'));
    }

    public function deleteFile(Request $request, FileToolsService $fileToolsService)
    {
        $fileId = $request->input('file_id');
        $emailFile = EmailFile::findOrFail($fileId);
        if (! $emailFile) {
            return redirect()->route('admin.email.index')->with('swal-error', 'فایل مورد نظر یافت نشد.');
        }
        if (! $fileToolsService->deleteFile($emailFile->file_path)) {
            return redirect()->route('admin.email.index')->with('swal-error', 'حذف فایل از فضای ذخیره‌سازی با مشکل مواجه شد.');
        }
        $emailFile->delete();

        return redirect()->route('admin.email.index')->with('swal-success', 'فایل با موفقیت حذف شد.');
    }

    public function downloadFile(EmailFile $file)
    {
        return response()->download(storage_path('app'. DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . $file->file_path));
    }

    public function sendEmail()
    {

    }
}
