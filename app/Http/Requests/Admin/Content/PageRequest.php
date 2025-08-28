<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
                "title" => "required|string|min:3|max:120|regex:/^[a-zA-Z0-9ا-ی\s\-_؟?]+$/u",
                "body" => "required|string|min:50|max:500",
                "status" => "required|numeric|in:0,1",
                "tags" => "required|string|min:3|max:120",
            ];
        } elseif ($this->isMethod('PUT')) {
            return [
                "title" => "required|string|min:3|max:120|regex:/^[a-zA-Z0-9ا-ی\s\-_؟?]+$/u",
                "body" => "required|string|min:50|max:500",
                "status" => "required|numeric|in:0,1",
                "tags" => "required|string|min:3|max:120",
            ];
        }
    }

    public function messages(): array
    {
        return [
            'title.required'  => 'فیلد عنوان اجباری می‌باشد.',
            'title.string'    => 'مقدار عنوان باید یک رشته معتبر باشد.',
            'title.min'       => 'حداقل طول عنوان باید 3 کاراکتر باشد.',
            'title.max'       => 'حداکثر طول عنوان مجاز 120 کاراکتر است.',
            'title.regex'     => 'عنوان فقط می‌تواند شامل حروف انگلیسی، فارسی، اعداد و کاراکترهای مجاز باشد. از کاراکترهای خاص مانند !@#$ و فاصله اضافی پرهیز کنید.',
            'body.required'   => 'فیلد محتوا اجباری می‌باشد.',
            'body.string'     => 'مقدار محتوا باید یک رشته معتبر باشد.',
            'body.min'        => 'حداقل طول محتوا باید 50 کاراکتر باشد.',
            'body.max'        => 'حداکثر طول محتوا مجاز 500 کاراکتر است.',
            'status.required' => 'فیلد وضعیت اجباری می‌باشد.',
            'status.numeric'  => 'وضعیت باید یک عدد باشد.',
            'status.in'       => 'مقدار وضعیت باید 0 (غیرفعال) یا 1 (فعال) باشد.',
            'tags.required'   => 'فیلد برچسب‌ها اجباری می‌باشد.',
            'tags.string'     => 'برچسب‌ها باید یک رشته معتبر باشند.',
            'tags.min'        => 'حداقل طول برچسب‌ها باید 3 کاراکتر باشد.',
            'tags.max'        => 'حداکثر طول برچسب‌ها مجاز 120 کاراکتر است.',
        ];
    }
}
