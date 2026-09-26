<?php

namespace App\Http\Requests\Admin\Notification;

use Illuminate\Foundation\Http\FormRequest;

class SMSRequest extends FormRequest
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
            "title" => "required|string|min:3|max:255",
            "body" => "required|string|min:3|max:500",
            "published_at" => "required|string",
        ];
    }

    public function messages(): array
    {
        return [
            "title.required" => "فیلد عنوان الزامی می باشد",
            "title.string" => "فیلد عنوان نباید کاراکتر های غیر مجاز داشته باشد",
            "title.max" => "فیلد عنوان نمی تواند بیشتر از 255 کاراکتر باشد",
            "title.min" => "فیلد عنوان نمی تواند کمتر از 3 کاراکتر داشته باشد",
            "body.required" => "فیلد متن پیام الزامی است",
            "body.string" => "فیلد متن پیام نباید کاراکتر های غیر مجاز داشته باشد",
            "body.max" => "فیلد متن پیام نباید بیشتر از 500 کاراکتر باشد",
            "body.min" => "فیلد متن پیام نباید کمتر از 3 کاراکتر باشد",
            "published_at.required" => "فیلد تاریخ انتشار الزامی است",
            "published_at.date" => "فیلد تاریخ انتشار باید تاریخ باشد",
        ];

    }
}
