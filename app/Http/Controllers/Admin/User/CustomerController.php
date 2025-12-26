<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CustomerRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use App\Notifications\NewUserRegister;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('user_type' , 0)->simplePaginate(10);
        return view('admin.user.customer.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request, ImageService $imageService)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();

            if ($request->hasFile('profile_photo_path')) {
                $image = $request->file('profile_photo_path');
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
                $result = $imageService->save($image);
                if ($result === false) {
                    return redirect()
                        ->back()
                        ->with('swal-error', 'مشکلی در آپلود عکس پیش آمده است');
                }
                $validated['profile_photo_path'] = $result;
            }

            $validated['password'] = Hash::make($validated['password']);
            $validated['user_type'] = 0;
            $validated['status'] = 1;
            $validated['activation_date'] = now();
            $validated['slug'] = Str::slug(
                $validated['first_name'] . '-' . $validated['last_name'] . '-' . Str::random(5)
            );

            $user = User::create($validated);

            DB::commit();
            //Testing Notification
            $details = [
                "message" => "یک کاربر جدید با ایمیل $user->email در سایت ثبت نام کرد"
            ];
            $adminUser = User::find(279);
            $adminUser->notify(new NewUserRegister($details));
            return redirect()->route('admin.user.customer.index')
                ->with('swal-success', 'کاربر مشتری با موفقیت ایجاد شد: ' . $user->first_name);

        } catch (QueryException $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("QueryException [$errorID] " . $e->getMessage());
            return redirect()->back()->with('swal-error', 'مشکلی در ذخیره داده در دیتابیس بوجود آمد: ' . $errorID);
        } catch (\Exception $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis') . rand(1000 , 9999);
            \Log::error("Exception [$errorID] " . $e->getMessage());
            return redirect()->back()->with('swal-error', 'خطای داخلی: ' . $errorID);
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
    public function edit(User $user)
    {
        return view('admin.user.customer.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, User $user, ImageService $imageService)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_photo_path')) {
            if ($user->profile_photo_path) {
                $imageService->deleteFile($user->profile_photo_path);
            }

            $image = $request->file('profile_photo_path');
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($image);

            if ($result === false) {
                return redirect()
                    ->back()
                    ->with('swal-error', 'مشکلی در آپلود عکس پیش آمده است');
            }

            $data['profile_photo_path'] = $result;
        }

        $user->update($data);
        return redirect()->route('admin.user.customer.index')
            ->with('swal-success', "کاربر {$user->first_name} با موفقیت ویرایش شد");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->forceDelete();
        return redirect()->route('admin.user.admin-user.index')
            ->with('swal-success' , 'کاربر ادمین با موفقیت حذف شد');
    }

    public function activation(User $user)
    {
        $user->activation = $user->activation == 0 ? 1 : 0;
        $result = $user->save();
        if ($result) {
            if ($user->activation == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false,
                ]);
            } else {
                if ($user->activation == 1) {
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

    public function status(User $user)
    {
        $user->status = $user->status == 0 ? 1 : 0;
        $result = $user->save();
        if ($result) {
            if ($user->status == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false,
                ]);
            } else {
                if ($user->status == 1) {
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
