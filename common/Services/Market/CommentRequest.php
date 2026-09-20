<?php

namespace Common\Services\Market;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!auth()->check()) return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'required|string|min:5|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'comment.required' => 'متن خود را وارد کنید',
            'comment.string' => 'نوع متن اشتباه است',
            'comment.max' => 'مقدار ورودی نمی تواند بیش از ۲۵۵ کاراکتر باشد',
            'comment.min' => 'مقدار ورودی نمی تواند کمتر از ۵ کاراکتر باشد'
        ];
    }
}
