<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyRequest extends FormRequest
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
                "name" => "required|string|max:255|regex:/^[\p{L}\p{N}\s\?\!\-\_\.\:\;]+$/u",
                "type" => "required", Rule::in(['text','select','checkbox','radio','textarea']),
                "unit" => "required|string|max:255|regex:/^[\p{L}\p{N}\s\?\!\-\_\.\:\;]+$/u",
                "category_id" => "required|exists:product_categories,id",
            ];
        } elseif ($this->isMethod('PATCH') || $this->isMethod('PUT')) {
            return [
                "name" => "required|string|max:255|regex:/^[\p{L}\p{N}\s\?\!\-\_\.\:\;]+$/u",
                "type" => "required", Rule::in(['text','select','checkbox','radio','textarea']),
                "unit" => "required|string|max:255|regex:/^[\p{L}\p{N}\s\?\!\-\_\.\:\;]+$/u",
                "category_id" => "required|exists:product_categories,id",
            ];
        }
        abort(403);
    }

    public function messages(): array
    {
        return [
            "name.required" => "نام کالا الزامی است.",
            "name.string" => "نام کالا باید از نوع رشته‌ای باشد.",
            "name.max" => "نام کالا نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.",
            "name.regex" => "نام کالا شامل کاراکتر نامعتبر است.",

            "type.required" => "نوع نمایش ویژگی الزامی است.",
            "type.in" => "نوع نمایش ویژگی معتبر نیست.",

            "unit.required" => "واحد کالا الزامی است.",
            "unit.string" => "واحد کالا باید از نوع رشته‌ای باشد.",
            "unit.max" => "واحد کالا نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.",
            "unit.regex" => "واحد کالا شامل کاراکتر نامعتبر است.",

            "category_id.required" => "انتخاب دسته‌بندی الزامی است.",
            "category_id.exists" => "دسته‌بندی انتخاب‌شده معتبر نیست.",
        ];
    }
}
