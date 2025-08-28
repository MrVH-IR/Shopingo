<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class FAQRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'question' => 'required|string|min:3|max:200|regex:/^[ا-یء-يa-zA-Z0-9۰-۹.,?؟ ]+$/u',
                'tags' => 'required|min:1|max:120',
                'status' => 'required|numeric|in:0,1',
                'answer' => 'required|string|max:500|min:5',
            ];
        } elseif ($this->isMethod('put')) {
            return [
                'question' => 'required|string|min:3|max:120|regex:/^[ا-یء-يa-zA-Z0-9۰-۹.,?؟ ]+$/u',
                'tags' => 'required',
                'status' => 'required|numeric|in:0,1',
                'answer' => 'required|string|max:500|min:5',
            ];
        } else {
            return response()->with('swal-error', 'Error In Validation - PostREQ')->route('admin.content.postCategory.index');
        }
    }

    public function messages(): array
    {
        return [
            'question.required' => 'فیلد پرسش الزامی میباشد',
            'question.min' => 'فیلد پرسش باید حداقل 3 کاراکتر باشد',
            'question.max' => 'فیلم پرسش نباید بیشتر از 200 کاراکتر باشد',
            'question.regex' => 'از کاراکتر های مجاز استفاده کنید',
            'question.string' => 'در استفاده از کاراکتر های غیر مجاز پرهیز کنید',
            'tags.required' => 'تگ‌ها الزامی هستند.',
            'tags.min' => 'حداقل کارکتر تگ 2 کارکتر می باشد',
            'tags.max' => 'حداکثر کارکتر های تگ ها 10 تا می باشند',
            'status.required' => 'وضعیت را انتخاب کنید.',
            'status.numeric' => 'وضعیت باید فعال یا غیر فعال باشد',
            'status.in' => 'وضعیت باید ۰ یا ۱ باشد.',
            'answer.required' => 'فیلد پاسخ الزامی است.',
            'answer.min' => 'جواب نباید کمتر از ۵ کاراکتر باشد.',
            'answer.max' => 'جواب نباید بیشتر از 500 کاراکتر باشد',
            'answer.string' => 'از گذاشتن کاراکتر های غیر مجاز خوداری فرمایید'
        ];
    }
}
