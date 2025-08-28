<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
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
        if ($this->isMethod('post')) {
                return [
                    'name' => 'required|string|min:3|max:120|regex:/^[ا-یء-يa-zA-Z0-9۰-۹., ]+$/u',
                    'tags' => 'required',
                    'status' => 'required|numeric|in:0,1',
                    'image' => 'required|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
                    'description' => 'required|string|max:500|min:5',
            ];
        } elseif ($this->isMethod('patch') || $this->isMethod('put')) {
            return [
                'name' => 'required|string|min:3|max:200|regex:/^[ا-یء-يa-zA-Z0-9۰-۹., ]+$/u',
                'tags' => 'required',
                'status' => 'required|numeric|in:0,1',
                'image' => 'image|mimes:png,jpg,jpeg,webp,svg|max:2048',
                'description' => 'required|string|max:500|min:5',
            ];
        } else {
            return response()->with('swal-error', 'Error In Validation - PostREQ')->route('admin.content.postCategory.index');
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'فیلد نام الزامی میباشد',
            'name.min' => 'فیلد نام باید حداقل 3 کاراکتر باشد',
            'name.max' => 'فیلم نام نباید بیشتر از 200 کاراکتر باشد',
            'name.regex' => 'از کاراکتر های مجاز استفاده کنید',
            'tags.required' => 'تگ‌ها الزامی هستند.',
            'status.required' => 'وضعیت را انتخاب کنید.',
            'status.numeric' => 'وضعیت باید فعال یا غیر فعال باشد',
            'status.in' => 'وضعیت باید ۰ یا ۱ باشد.',
            'image.required' => 'آپلود تصویر الزامی است.',
            'image.image' => 'فایل انتخاب شده باید یک تصویر معتبر باشد.',
            'image.mimes' => 'فرمت تصویر باید یکی از این‌ها باشد: png, jpg, jpeg, webp, svg.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
            'description.required' => 'توضیحات الزامی است.',
            'description.min' => 'توضیحات نباید کمتر از ۵ کاراکتر باشد.',
            'description.max' => 'توضیحات نباید بیشتر از 500 کاراکتر باشد'
        ];
    }
}
