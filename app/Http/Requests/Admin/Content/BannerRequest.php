<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class BannerRequest extends FormRequest
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
    public function rules(): array|int
    {
        if ($this->isMethod('POST')) {
            return [
                'title' => 'required|string|max:120|min:2|regex:/^[\pL\pN\s\-\_\/() ]+$/u',
                'link' => 'required|url|max:600|min:5|regex:/^[\pL\pN\-\_\/:.?=&%#@!+\$]+$/u',
                'status' => 'required|integer|between:0,1',
                'position' => 'required|integer|between:0,3',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3048',
            ];
        } elseif ($this->isMethod('PATCH') || $this->isMethod('PUT')) {
            return [
                'title' => 'required|string|max:120|min:2|regex:/^[\pL\pN\s\-\_\/() ]+$/u',
                'link' => 'required|url|max:600|min:5|regex:/^[\pL\pN\-\_\/:.?=&%#@!+\$]+$/u',
                'status' => 'required|integer|between:0,1',
                'position' => 'required|integer|between:0,3',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:3048',
            ];
        } else {
            return Response::HTTP_BAD_REQUEST;
        }
    }

    public function messages(): array
    {
        return [
            'title.required' => '❌ تکمیل فیلد عنوان الزامی است.',
            'title.string' => '❌ عنوان باید از نوع متن باشد.',
            'title.max' => '❌ عنوان نمی‌تواند بیشتر از :max کاراکتر باشد.',
            'title.min' => '❌ عنوان باید حداقل :min کاراکتر باشد.',
            'title.regex' => '❌ عنوان فقط می‌تواند شامل حروف، فاصله و خط تیره باشد.',

            'link.required' => '❌ وارد کردن آدرس لینک الزامی است.',
            'link.url' => '❌ آدرس لینک معتبر نیست. لطفاً یک آدرس معتبر وارد کنید (مثال: https://example.com)',
            'link.max' => '❌ آدرس لینک نمی‌تواند بیشتر از :max کاراکتر باشد.',
            'link.min' => '❌ آدرس لینک باید حداقل :min کاراکتر باشد.',
            'link.regex' => '❌ آدرس لینک فقط می‌تواند شامل حروف، اعداد و خط تیره باشد.',

            'status.required' => '❌ انتخاب وضعیت (فعال/غیرفعال) الزامی است.',
            'status.integer' => '❌ مقدار وضعیت نامعتبر است.',
            'status.between' => '❌ مقدار وضعیت باید بین :min و :max باشد.',

            'position.required' => '❌ انتخاب موقعیت نمایش اسلایدر الزامی است.',
            'position.integer' => '❌ مقدار موقعیت نامعتبر است.',
            'position.between' => '❌ موقعیت باید بین :min و :max باشد.',

            'image.required' => '❌ انتخاب تصویر برای اسلایدر الزامی است.',
            'image.image' => '❌ فایل ارسالی باید از نوع تصویر باشد.',
            'image.mimes' => '❌ فرمت تصویر مجاز نیست. فرمت‌های مجاز: JPEG, PNG, JPG, GIF, SVG, WEBP',
            'image.max' => '❌ حجم تصویر نباید بیشتر از :max کیلوبایت باشد. (حداکثر ۳ مگابایت)',
        ];
    }
}
