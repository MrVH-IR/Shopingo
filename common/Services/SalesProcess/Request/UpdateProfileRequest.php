<?php

namespace Common\Services\SalesProcess\Request;

use Common\Controllers\SalesProcess\Rule\CheckNationalCode;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (auth()->check()) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'    => ['sometimes', 'required', 'string', 'max:150', 'regex:/^[\p{L}\s\x{200C}\-]+$/u'],
            'last_name'     => ['sometimes', 'required', 'string', 'max:150', 'regex:/^[\p{L}\s\x{200C}\-]+$/u'],
            'mobile'        => ['sometimes', 'required', 'digits_between:10,13', 'regex:/^(0|98|\+98)?9\d{9}$/', 'unique:users,mobile'],
            'national_code' => ['sometimes', 'required', new CheckNationalCode(), 'unique:users,national_code'],
            'email'         => ['sometimes', 'required', 'string', 'email', 'max:150', 'unique:users,email'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required'    => 'وارد کردن نام الزامی است.',
            'first_name.regex'       => 'نام فقط می‌تواند شامل حروف باشد.',
            'first_name.max'         => 'نام نمی‌تواند بیشتر از ۱۵۰ کاراکتر باشد.',

            'last_name.required'     => 'وارد کردن نام خانوادگی الزامی است.',
            'last_name.regex'        => 'نام خانوادگی فقط می‌تواند شامل حروف باشد.',
            'last_name.max'          => 'نام خانوادگی نمی‌تواند بیشتر از ۱۵۰ کاراکتر باشد.',

            'mobile.required'        => 'وارد کردن شماره موبایل الزامی است.',
            'mobile.digits_between'  => 'شماره موبایل باید بین ۱۰ تا ۱۳ رقم انگلیسی باشد.',
            'mobile.regex'           => 'فرمت شماره موبایل صحیح نمی‌باشد. مثال: 09121231234',
            'mobile.unique'          => 'شماره موبایل وارد شده قبلاً در سایت ثبت شده است.',

            'national_code.required' => 'وارد کردن کد ملی الزامی است.',
            'national_code.digits'   => 'کد ملی باید دقیقاً ۱۰ رقم انگلیسی باشد.',
            'national_code.regex'    => 'فرمت کد ملی صحیح نمی‌باشد.',
            'national_code.unique'   => 'کد ملی وارد شده قبلاً در سایت ثبت شده است.',

            'email.string'           => 'فرمت ایمیل صحیح نمی‌باشد.',
            'email.email'            => 'فرمت ایمیل وارد شده صحیح نیست.',
            'email.max'              => 'ایمیل نمی‌تواند بیشتر از ۱۵۰ کاراکتر باشد.',
            'email.unique'           => 'ایمیل وارد شده قبلاً در سایت ثبت شده است.',
            'email.required'         => 'فیلد ایمیل نمی تواند خالی باشد',
        ];
    }
}
