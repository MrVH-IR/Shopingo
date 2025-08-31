<?php

namespace App\Http\Requests\Admin\Notification;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            "subject" => "required|string|min:3|max:255",
            "body" => "required|string|min:3|max:500",
            "status" => "required|boolean|numeric|in:0,1",
            "published_at" => "required|string",
        ];
    }

    public function messages(): array
    {
        return [
            "subject.required" => "فیلد عنوان الزامی می باشد",
            "subject.string" => "فیلد عنوان نباید کاراکتر های غیر مجاز داشته باشد",
            "subject.max" => "فیلد عنوان نمی تواند بیشتر از 255 کاراکتر باشد",
            "subject.min" => "فیلد عنوان نمی تواند کمتر از 3 کاراکتر داشته باشد",
            "body.required" => "فیلد متن پیام الزامی است",
            "body.string" => "فیلد متن پیام نباید کاراکتر های غیر مجاز داشته باشد",
            "body.max" => "فیلد متن پیام نباید بیشتر از 500 کاراکتر باشد",
            "body.min" => "فیلد متن پیام نباید کمتر از 3 کاراکتر باشد",
            "status.in" => "فیلد وضعیت باید فعال یا غیر فعال باشد",
            "status.boolean" => "فیلد وضعیت باید فعال یا غیر فعال باشد",
            "status.required" => "فیلد وضعیت الزامی است",
            "status.numeric" => "فیلد وضغیت باید فعال یا غیر فعال باشد",
            "published_at.required" => "فیلد تاریخ انتشار الزامی است",
            "published_at.date" => "فیلد تاریخ انتشار باید تاریخ باشد",
        ];

    }
}
