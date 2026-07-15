<?php

namespace Common\Services\Profile\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (auth()->check()) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject' => 'required|string|max:150',
            'category_id' => 'required|exists:ticket_categories,id',
            'priority_id' => 'required|exists:ticket_priorities,id',
            'description' => 'required|string|max:3000',
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => 'عنوان تیکت الزامی است.',
            'subject.string' => 'عنوان تیکت باید یک رشته متنی باشد.',
            'subject.max' => 'عنوان تیکت نباید بیشتر از ۱۵۰ کاراکتر باشد.',

            'category_id.required' => 'انتخاب دسته‌بندی الزامی است.',
            'category_id.exists' => 'دسته‌بندی انتخاب‌ شده معتبر نیست.',

            'priority_id.required' => 'انتخاب اولویت الزامی است.',
            'priority_id.exists' => 'اولویت انتخاب‌ شده معتبر نیست.',

            'description.required' => 'متن تیکت الزامی است.',
            'description.string' => 'متن تیکت باید یک رشته متنی باشد.',
            'description.max' => 'متن تیکت نباید بیشتر از ۳۰۰۰ کاراکتر باشد.',
        ];
    }
}
