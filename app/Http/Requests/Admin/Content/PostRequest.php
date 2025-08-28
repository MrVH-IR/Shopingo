<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'title' => 'required|string|min:3|max:50|regex:/^[ا-یء-يa-zA-Z0-9۰-۹., ]+$/u',
                'tags' => 'required',
                'status' => 'required|numeric|in:0,1',
                'category_id' => 'required|min:1|numeric|regex:/^[0-9]+$/u|exists:post_categories,id',
                'image' => 'required|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
                'published_at' => 'required|date',
                'commentable' => 'required|boolean',
                'summary' => 'required|string|max:300|min:5',
                'body' => 'required|string|min:5|max:600',
            ];
        } elseif ($this->isMethod('patch') || $this->isMethod('put')) {
            return [
                'title' => 'required|string|min:3|max:50|regex:/^[ا-یء-يa-zA-Z0-9۰-۹., ]+$/u',
                'tags' => 'required',
                'status' => 'required|numeric|in:0,1',
                'category_id' => 'required|min:1|numeric|regex:/^[0-9]+$/u|exists:post_categories,id',
                'image' => 'image|mimes:png,jpg,jpeg,webp,svg|max:2048',
                'published_at' => 'date',
                'commentable' => 'required|boolean',
                'summary' => 'required|string|max:300|min:5',
                'body' => 'required|string|min:5|max:600',
            ];
        } else {
            return response()->with('swal-error', 'Error In Validation - PostREQ')->route('admin.content.postCategory.index');
        }
    }

    public function messages(): array
    {
        return [
            'title.required' => 'فیلد نام الزامی میباشد',
            'title.min' => 'فیلد نام باید حداقل 3 کاراکتر باشد',
            'title.max' => 'فیلم نام نباید بیشتر از 200 کاراکتر باشد',
            'title.regex' => 'از کاراکتر های مجاز استفاده کنید',
            'tags.required' => 'تگ‌ها الزامی هستند.',
            'status.required' => 'وضعیت را انتخاب کنید.',
            'status.numeric' => 'وضعیت باید فعال یا غیر فعال باشد',
            'status.in' => 'وضعیت باید ۰ یا ۱ باشد.',
            'category_id.exists' => 'دسته بندی مورد نظر وجود ندارد',
            'category_id.required' => 'دسته بندی را وارد کنید',
            'category_id.min' => 'حداقل عدد مورد قبول دسته بندی 1 می باشد',
            'category_id.numeric' => 'دسته بندی باید عدد باشد',
            'category_id.regex' => 'دسته بندی باید از 1 تا به بالا باشد',
            'published_at.date' => 'لطفا تاریخ را درست وارد کنید !',
            'published_at.date_format' => 'فرمت تاریخ صحیح نمی باشد',
            'published_at.required' => 'فیلد تاریخ الزامی میباشد',
            'commentable.required' => 'فیلد درج کامنت الزامی میباشد',
            'commentable.boolean' => 'فیلد درج کامنت باید فعال یا غیر فغال باشد',
            'image.required' => 'آپلود تصویر الزامی است.',
            'image.image' => 'فایل انتخاب شده باید یک تصویر معتبر باشد.',
            'image.mimes' => 'فرمت تصویر باید یکی از این‌ها باشد: png, jpg, jpeg, webp, svg.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
            'summary.required' => 'فیلد خلاصه الزامی است.',
            'summary.min' => 'فیلد خلاصه نباید کمتر از ۵ کاراکتر باشد.',
            'summary.max' => 'فیلد خلاصه نباید بیشتر از 300 کاراکتر باشد',
            'body.required' => 'فیلد محتوای پست الزامی میباشد',
            'body.string' => 'از کاراکتر های غیر مجاز استفاده نکنید',
            'body.max' => 'حداکثر 600 کاراکتر !',
            'body.min' => 'حداقل 5 کاراکتر'
        ];
    }
}
