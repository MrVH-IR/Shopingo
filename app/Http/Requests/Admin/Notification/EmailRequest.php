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
            "published_at" => "required|string",
            "file" => "nullable|array",
            "file.*" => [
                "file",
                "max:10240",
                "mimetypes:image/jpeg,image/png,image/gif,image/webp,image/svg+xml,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,application/vnd.oasis.opendocument.text,application/vnd.oasis.opendocument.spreadsheet,application/vnd.oasis.opendocument.presentation,application/rtf"
            ]
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
            "published_at.required" => "فیلد تاریخ انتشار الزامی است",
            "published_at.date" => "فیلد تاریخ انتشار باید تاریخ باشد",
            "file.file"       => "فایلی که انتخاب کرده‌اید معتبر نیست.",
            "file.max"        => "حجم فایل نباید بیشتر از ۱۰ مگابایت باشد.",
            "file.mimetypes"  => "فرمت یا نوع فایل انتخابی پشتیبانی نمی‌شود.
            لطفاً یکی از فرمت‌های مجاز را آپلود کنید:
            JPG, PNG, GIF, WEBP, SVG, PDF, DOC, DOCX, XLS, XLSX, CSV, ODT, ODS, ODP, TXT, RTF.",
        ];

    }
}
