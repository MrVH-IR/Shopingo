<?php

namespace Common\Services\Profile\Requests;

use Common\Services\SalesProcess\Rule\CheckNationalCode;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
            'first_name'    => ['nullable', 'required', 'string', 'max:150', 'regex:/^[\p{L}\s\x{200C}\-]+$/u'],
            'last_name'     => ['nullable', 'required', 'string', 'max:150', 'regex:/^[\p{L}\s\x{200C}\-]+$/u'],
            'national_code' => ['nullable', 'required', new CheckNationalCode(), Rule::unique('users', 'national_code')->ignore($this->user()->national_code)],
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

            'national_code.required' => 'وارد کردن کد ملی الزامی است.',
            'national_code.digits'   => 'کد ملی باید دقیقاً ۱۰ رقم انگلیسی باشد.',
            'national_code.regex'    => 'فرمت کد ملی صحیح نمی‌باشد.',
            'national_code.unique'   => 'کد ملی وارد شده قبلاً در سایت ثبت شده است.',
        ];
    }
}
