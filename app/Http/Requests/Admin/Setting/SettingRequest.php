<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        return [
            "title" => "required|string|min:3|max:30",
            "description" => "required|string|min:10|max:100",
            "keywords" => "required|string|min:10|max:200",
            "logo" => "nullable|max:2048|mimes:jpeg,png,gif,webp,svg",
            "favicon" => "nullable|max:2048|mimes:jpeg,png,gif,webp,svg,ico",
        ];
    }

    public function messages(): array
    {
        return [
            "title.required" => "فیلد عنوان سایت الزامی است.",
            "title.string"   => "فیلد عنوان سایت باید متن باشد.",
            "title.min"      => "فیلد عنوان سایت نباید کمتر از 3 کاراکتر باشد.",
            "title.max"      => "فیلد عنوان سایت نباید بیشتر از 30 کاراکتر باشد.",

            "description.required" => "فیلد توضیحات سایت الزامی است.",
            "description.string"   => "فیلد توضیحات باید متن باشد.",
            "description.min"      => "فیلد توضیحات نباید کمتر از 10 کاراکتر باشد.",
            "description.max"      => "فیلد توضیحات نباید بیشتر از 100 کاراکتر باشد.",

            "keywords.required" => "فیلد کلمات کلیدی سایت الزامی است.",
            "keywords.string"   => "فیلد کلمات کلیدی باید متن باشد.",
            "keywords.min"      => "فیلد کلمات کلیدی نباید کمتر از 10 کاراکتر باشد.",
            "keywords.max"      => "فیلد کلمات کلیدی نباید بیشتر از 200 کاراکتر باشد.",

            "logo.max"      => "حجم لوگو نباید بیشتر از 2 مگابایت باشد.",
            "logo.mimes"    => "لوگو باید یکی از فرمت‌های jpeg, png, gif, webp یا svg باشد.",

            "favicon.max"      => "حجم آیکون نباید بیشتر از 2 مگابایت باشد.",
            "favicon.mimes"    => "آیکون باید یکی از فرمت‌های jpeg, png, gif, webp, svg یا ico باشد.",
        ];
    }
}
