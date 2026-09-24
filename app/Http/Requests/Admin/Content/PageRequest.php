<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $body = $this->input('body');
            $customStyle = $this->input('customStyle');

            if (blank($body) && blank($customStyle)) {
                $validator->errors()->add('body', 'فیلد محتوا یا شخصی‌سازی باید وارد شود.');
                $validator->errors()->add('customStyle', 'فیلد محتوا یا شخصی‌سازی باید وارد شود.');
            }

            if (filled($body) && filled($customStyle)) {
                $validator->errors()->add('body', 'فقط یکی از فیلدهای محتوا یا شخصی‌سازی را وارد کنید.');
                $validator->errors()->add('customStyle', 'فقط یکی از فیلدهای محتوا یا شخصی‌سازی را وارد کنید.');
            }
        });
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
                "title" => "required|string|min:3|max:120|regex:/^[a-zA-Z0-9ا-ی\s\-_؟?]+$/u",
                "body" => "nullable|string|min:50|max:50000",
                "customStyle" => "nullable|string|min:10|max:50000",
                "status" => "required|numeric|in:0,1",
                "tags" => "required|string|min:3|max:120",
            ];
        }

        if ($this->isMethod('PUT')) {
            return [
                "title" => "required|string|min:3|max:120|regex:/^[a-zA-Z0-9ا-ی\s\-_؟?]+$/u",
                "body" => "nullable|string|min:50|max:50000",
                "customStyle" => "nullable|string|min:10|max:50000",
                "status" => "required|numeric|in:0,1",
                "tags" => "required|string|min:3|max:120",
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'title.required'        => 'وارد کردن عنوان الزامی است.',
            'title.string'          => 'عنوان باید یک متن معتبر باشد.',
            'title.min'             => 'عنوان باید حداقل ۳ کاراکتر داشته باشد.',
            'title.max'             => 'عنوان نمی‌تواند بیشتر از ۱۲۰ کاراکتر باشد.',
            'title.regex'           => 'عنوان فقط می‌تواند شامل حروف فارسی، انگلیسی، اعداد، فاصله و کاراکترهای -، _ و ؟ باشد.',
            'body.string'           => 'محتوا باید یک متن معتبر باشد.',
            'body.min'              => 'محتوا باید حداقل ۵۰ کاراکتر داشته باشد.',
            'body.max'              => 'محتوا نمی‌تواند بیشتر از ۵۰۰۰۰ کاراکتر باشد.',
            'customStyle.string'    => 'کد شخصی‌سازی باید یک متن معتبر باشد.',
            'customStyle.min'       => 'کد شخصی‌سازی باید حداقل ۱۰ کاراکتر داشته باشد.',
            'customStyle.max'       => 'کد شخصی‌سازی نمی‌تواند بیشتر از ۵۰۰۰۰ کاراکتر باشد.',
            'status.required'       => 'وارد کردن وضعیت صفحه الزامی است.',
            'status.numeric'        => 'وضعیت صفحه باید یک مقدار عددی باشد.',
            'status.in'             => 'وضعیت صفحه باید فعال یا غیرفعال باشد.',
            'tags.required'         => 'وارد کردن برچسب‌ها الزامی است.',
            'tags.string'           => 'برچسب‌ها باید یک متن معتبر باشند.',
            'tags.min'              =>'برچسب‌ها باید حداقل ۳ کاراکتر داشته باشند.',
            'tags.max'              => 'برچسب‌ها نمی‌توانند بیشتر از ۱۲۰ کاراکتر باشند.',
        ];
    }
}
