<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
                'show_in_menu' => 'required|numeric|in:0,1',
                'parent_id' => 'nullable|min:1|max:10000000|numeric|regex:/^[0-9]+$/u|exists:product_categories,id',
            ];
        } elseif ($this->isMethod('patch') || $this->isMethod('put')) {
            return [
                'name' => 'required|string|min:3|max:200|regex:/^[ا-یء-يa-zA-Z0-9۰-۹., ]+$/u',
                'tags' => 'required',
                'status' => 'required|numeric|in:0,1',
                'show_in_menu' => 'required|numeric|in:0,1',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
                'description' => 'required|string|max:500|min:5',
                'parent_id' => 'nullable|min:1|max:10000000|numeric|regex:/^[0-9]+$/u|exists:product_categories,id',
            ];
        } else {
            return response()->with('swal-error', 'Error In Validation - PostREQ')
                ->route('admin.market.category.index');
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'فیلد نام اجباری می‌باشد.',
            'name.string'   => 'فیلد نام باید متنی باشد.',
            'name.min'      => 'نام باید حداقل :min کاراکتر باشد.',
            'name.max'      => 'نام نمی‌تواند بیشتر از :max کاراکتر باشد.',
            'name.regex'    => 'نام فقط می‌تواند شامل حروف فارسی، انگلیسی، اعداد و علائم (. ,) باشد.',

            'tags.required' => 'وارد کردن برچسب‌ها اجباری است.',

            'status.required' => 'وضعیت اجباری می‌باشد.',
            'status.numeric'  => 'وضعیت باید عددی باشد.',
            'status.in'       => 'وضعیت نامعتبر است. فقط 0 یا 1 مجاز می‌باشد.',

            'image.required' => 'انتخاب تصویر اجباری است.',
            'image.image'    => 'فایل انتخابی باید یک تصویر باشد.',
            'image.mimes'    => 'تصویر فقط می‌تواند یکی از فرمت‌های png, jpg, jpeg, webp, svg باشد.',
            'image.max'      => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',

            'description.required' => 'توضیحات اجباری می‌باشد.',
            'description.string'   => 'توضیحات باید متنی باشد.',
            'description.min'      => 'توضیحات باید حداقل :min کاراکتر باشد.',
            'description.max'      => 'توضیحات نمی‌تواند بیشتر از :max کاراکتر باشد.',

            'show_in_menu.required' => 'نمایش در منو اجباری است.',
            'show_in_menu.numeric'  => 'نمایش در منو باید عددی باشد.',
            'show_in_menu.in'       => 'گزینه‌ی نمایش در منو نامعتبر است. فقط 0 یا 1 مجاز می‌باشد.',

            'parent_id.min'     => 'شناسه والد باید حداقل :min باشد.',
            'parent_id.max'     => 'شناسه والد نمی‌تواند بیشتر از :max باشد.',
            'parent_id.numeric' => 'شناسه والد باید عددی باشد.',
            'parent_id.regex'   => 'شناسه والد باید فقط شامل اعداد باشد.',
            'parent_id.exists'  => 'شناسه والد انتخاب شده معتبر نیست.',
        ];
    }
}
