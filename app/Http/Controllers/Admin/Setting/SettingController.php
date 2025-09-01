<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Setting\Setting;
use Database\Seeders\SettingSeeder;
use Hamcrest\Core\Set;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        if ($setting == null) {
            $default = new SettingSeeder();
            $default->run();
            $setting = Setting::first();
        }
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, Setting $setting, ImageService $imageService): RedirectResponse
    {
        DB::beginTransaction();

        $validated = $request->validated();

        try {
            $logoResult = null;
            if ($request->hasFile('logo')) {
                if ($setting->logo !== null) {
                    $imageService->deleteDirectoryAndFiles($setting->logo);
                }
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting' . DIRECTORY_SEPARATOR . 'logo');
                $imageService->setImageName('logo');
                $logoResult = $imageService->save($request->file('logo'));

                if ($logoResult === false) {
                    return redirect()
                        ->back()
                        ->with('swal-error', 'مشکلی در آپلود لوگو پیش آمده است');
                }

                $validated['logo'] = $logoResult;
            }
            // Image Intervention Does not Support ICO , SVG
//            if ($request->hasFile('favicon')) {
//                if ($setting->favicon !== null) {
//                    $imageService->deleteDirectoryAndFiles($setting->favicon);
//                }
//                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting' . DIRECTORY_SEPARATOR . 'favicon');
//                $imageService->setImageName('favicon');
//                $faviconResult = $imageService->save($request->file('favicon'));
//                if ($faviconResult === false) {
//                    return redirect()
//                        ->back()
//                        ->with('swal-error' , 'مشکلی در آپلود لوگو سایت پیش آمده است');
//                }
//                $validated['favicon'] = $faviconResult;
//            }

            if ($request->hasFile('favicon')) {
                $favicon = $request->file('favicon');
                $ext = strtolower($favicon->getClientOriginalExtension());
                $filename = 'favicon.' . $ext;
                $directory = 'images/setting/favicon';

                if (!file_exists(public_path($directory))) {
                    mkdir(public_path($directory), 0755, true);
                }

                if (in_array($ext, ['ico', 'svg'])) {
                    $favicon->move(public_path($directory), $filename);
                } else {
                    $manager = new ImageManager(\GdImage::class);
                    $manager->make($favicon->getRealPath())
                        ->save(public_path("$directory/$filename"), 90, $ext);
                }

                $validated['favicon'] = "$directory/$filename";
            }

            $result = $setting->update($validated);
            if ($result === false) {
                DB::rollBack();
                return redirect()
                    ->back()
                    ->with('swal-error', 'مشکلی در آپدیت تنظیمات سایت بوجود آمده است');
            }
            DB::commit();
            return redirect()
                ->route('admin.setting.index')
                ->with('swal-success', 'تنظیمات سایت با موفقیت ویرایش شد');

        } catch (\Throwable $th) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000, 9999);
            \Log::error("Exception : [$errorID]" . $th->getMessage());
            return redirect()
                ->back()
                ->with("swal-error", "خطای داخلی: " . $errorID)
                ->withInput();
        }
    }
}
