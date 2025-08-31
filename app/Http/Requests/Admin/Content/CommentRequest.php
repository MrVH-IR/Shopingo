<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            "body" => "required|string|min:2|max:10000|regex:/^[a-zA-Z0-9ا-ی\s.,!?؛،؟]+$/u"
        ];
    }

    public function messages(): array
    {
        return [
            "body.min" => "حداقل فیلد پاسخ ادمین 2 کاراکتر می باشد",
            "body.max" => "جداکثر فیلد پاسخ ادمین 10000 کاراکتر می باشد",
            "body.string" => "فیلد پاسخ ادمین باید از جنس string باشد",
            "body.regex" => "فیلد پاسخ ادمین فقط می تواند از کارکتر های معمولی پشتیبانی کند",
            "body.required" => "فیلد پاسخ ادمین نمی تواند خالی باشد",
        ];
    }
}
