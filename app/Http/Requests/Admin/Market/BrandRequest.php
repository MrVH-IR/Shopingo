<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return [
                "persian_name" => "required|string|min:3|max:255|regex:/^[\pL\pN\s\-\_\/() ]+$/u",
                "original_name" => "required|string|min:3|max:255|regex:/^[\pL\pN\s\-\_\/() ]+$/u",
                "status" => "required|numeric:in:0,1",
                "image" => "required|image|mimes:jpeg,png,jpg,webp,svg|max:2048",
                "tags" => "required|min:1",
                "tags.*" => "required|string|min:3|max:50|regex:/^[\pL\pN\s\-\_\/() ]+$/u",
                ];
        } else {
            return [
                "persian_name" => "required|string|min:3|max:255|regex:/^[\pL\pN\s\-\_\/() ]+$/u",
                "original_name" => "required|string|min:3|max:255|regex:/^[\pL\pN\s\-\_\/() ]+$/u",
                "status" => "required|numeric:in:0,1",
                "image" => "image|mimes:jpeg,png,jpg,webp,svg|max:2048",
                "tags" => "required|min:1",
                "tags.*" => "required|string|min:3|max:50|regex:/^[\pL\pN\s\-\_\/() ]+$/u",
                ];
        }
    }

    public function messages(): array
    {
        return [
            "persian_name.required" => "نام فارسی الزامی است.",
            "persian_name.string" => "نام فارسی باید یک رشته متنی باشد.",
            "persian_name.min" => "نام فارسی باید حداقل ۳ کاراکتر باشد.",
            "persian_name.max" => "نام فارسی نباید بیشتر از ۲۵۵ کاراکتر باشد.",
            "persian_name.regex" => "نام فارسی فقط می‌تواند شامل حروف فارسی، انگلیسی، اعداد و فاصله باشد.",

            "original_name.required" => "نام اصلی الزامی است.",
            "original_name.string" => "نام اصلی باید یک رشته متنی باشد.",
            "original_name.min" => "نام اصلی باید حداقل ۳ کاراکتر باشد.",
            "original_name.max" => "نام اصلی نباید بیشتر از ۲۵۵ کاراکتر باشد.",
            "original_name.regex" => "نام اصلی فقط می‌تواند شامل حروف انگلیسی، اعداد و فاصله باشد.",

            "status.required" => "وضعیت الزامی است.",
            "status.in" => "وضعیت باید ۰ (غیرفعال) یا ۱ (فعال) باشد.",
            "status.numeric" => "فیلد وضعیت باید شماره باشد.",

            "image.required" => "بارگذاری تصویر الزامی است.",
            "image.image" => "فایل ارسالی باید یک تصویر باشد.",
            "image.mimes" => "فرمت تصویر باید یکی از موارد jpeg، png، jpg، webp یا svg باشد.",
            "image.max" => "حجم تصویر نباید بیشتر از ۲ مگابایت باشد.",

            "tags.required" => "برچسب‌ها الزامی هستند.",
            "tags.min" => "حداقل یک برچسب وارد کنید.",
            "tags.*.required" => "هر برچسب الزامی است.",
            "tags.*.string" => "هر برچسب باید یک رشته متنی باشد.",
            "tags.*.min" => "هر برچسب باید حداقل ۳ کاراکتر باشد.",
            "tags.*.max" => "هر برچسب نباید بیشتر از ۵۰ کاراکتر باشد.",
            "tags.*.regex" => "برچسب‌ها فقط می‌توانند شامل حروف فارسی، انگلیسی، اعداد و فاصله باشند.",
        ];
    }
}
