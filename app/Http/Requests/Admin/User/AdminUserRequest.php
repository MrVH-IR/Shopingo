<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (! in_array($this->method(), ['PUT' , 'POST'])) {
            abort(405, 'Method Not Allowed Friend');
        }

        if ($this->isMethod('POST')) {
            return [
                "first_name" => "required|string|max:120|min:3|regex:/^[\p{L}\s‌]+$/u",
                "last_name"  => "required|string|max:120|min:3|regex:/^[\p{L}\s‌]+$/u",
                "email"      => "required|string|email|max:120|unique:users,email",
                "mobile"     => "required|string|digits:11|unique:users,mobile|regex:/^[0-9]+$/u",
                "password"   => [
                    "required",
                    "confirmed",
                    Password::min(8)
                        ->max(24)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(),
                ],
                "profile_photo_path" => "nullable|image|mimes:jpeg,png,jpg,svg|max:2048",
                "activation"         => "required|numeric|in:0,1",
            ];
        }

        if ($this->isMethod('PUT')) {
            return [
                "first_name"        => "required|string|max:120|min:3|regex:/^[\p{L}\s‌]+$/u",
                "last_name"         => "required|string|max:120|min:3|regex:/^[\p{L}\s‌]+$/u",
                "profile_photo_path" => "nullable|image|mimes:jpeg,png,jpg,svg|max:2048",
            ];
        }
    }

    public function messages(): array
    {
        return [
            'first_name.required'       => 'فیلد نام الزامی است.',
            'first_name.string'         => 'فیلد نام باید شامل حروف باشد.',
            'first_name.max'            => 'فیلد نام نباید بیشتر از 120 کاراکتر باشد.',
            'first_name.min'            => 'فیلد نام نباید کمتر از 3 کاراکتر باشد.',
            'first_name.regex'          => 'فیلد نام فقط می‌تواند شامل حروف فارسی یا انگلیسی باشد و نباید شامل عدد یا کاراکتر خاص باشد.',

            'last_name.required'        => 'فیلد نام خانوادگی الزامی است.',
            'last_name.string'          => 'فیلد نام خانوادگی باید شامل حروف باشد.',
            'last_name.max'             => 'فیلد نام خانوادگی نباید بیشتر از 120 کاراکتر باشد.',
            'last_name.min'             => 'فیلد نام خانوادگی نباید کمتر از 3 کاراکتر باشد.',
            'last_name.regex'           => 'فیلد نام خانوادگی فقط می‌تواند شامل حروف فارسی یا انگلیسی باشد و نباید شامل عدد یا کاراکتر خاص باشد.',

            'email.required'            => 'فیلد ایمیل الزامی است.',
            'email.string'              => 'فیلد ایمیل باید یک رشته معتبر باشد.',
            'email.email'               => 'فیلد ایمیل باید یک آدرس ایمیل معتبر باشد.',
            'email.max'                 => 'فیلد ایمیل نباید بیشتر از 120 کاراکتر باشد.',
            'email.unique'              => 'این آدرس ایمیل قبلاً ثبت شده است. لطفاً از ایمیل دیگری استفاده کنید.',

            'mobile.required'           => 'فیلد شماره موبایل الزامی است.',
            'mobile.string'             => 'فیلد شماره موبایل باید یک رشته باشد.',
            'mobile.digits'             => 'شماره موبایل باید دقیقاً 11 رقم باشد.',
            'mobile.regex'              => 'شماره موبایل فقط باید شامل اعداد باشد.',
            'mobile.unique'             => 'این شماره موبایل قبلاً ثبت شده است.',

            'password.required'         => 'فیلد رمز عبور الزامی است.',
            'password.min'              => 'رمز عبور باید حداقل 8 کاراکتر باشد.',
            'password.confirmed'        => 'تکرار رمز عبور با رمز اصلی مطابقت ندارد.',
            'password'                  => 'رمز عبور باید شامل حروف کوچک و بزرگ، عدد و کاراکتر خاص باشد و از رمزهای نشت کرده در سطح اینترنت استفاده نشود.',

            'profile_photo_path.image'  => 'فایل انتخابی باید یک تصویر باشد.',
            'profile_photo_path.mimes'  => 'فرمت تصویر باید یکی از موارد زیر باشد: jpeg, png, jpg, svg.',
            'profile_photo_path.max'    => 'حجم تصویر نباید بیشتر از 2 مگابایت باشد.',

            'activation.required'       => 'فیلد وضعیت فعال‌سازی الزامی است.',
            'activation.numeric'        => 'وضعیت فعال‌سازی باید عددی باشد.',
            'activation.in'             => 'وضعیت فعال‌سازی باید 0 (غیرفعال) یا 1 (فعال) باشد.',
        ];
    }
}
