<?php

namespace Common\Controllers\SalesProcess;

use AllowDynamicProperties;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
//        if (auth()->check()) return true;
//        else return false;
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
            'color' => 'nullable|string|exists:product_colors,id',
            'guarantee' => 'nullable|exists:guarantees,id',
            'number' => 'required|numeric|min:1|max:5',
        ];
    }

    public function messages(): array
    {
        return [
            'color.string' => 'رنگ انتخاب شده معتبر نیست.',
            'color.exists' => 'رنگ انتخاب شده یافت نشد.',
            'guarantee.exists' => 'گارانتی انتخاب شده معتبر نیست.',
            'number.required' => 'تعداد محصول را وارد کنید.',
            'number.numeric' => 'تعداد محصول باید عدد باشد.',
            'number.min' => 'حداقل تعداد قابل سفارش ۱ عدد است.',
            'number.max' => 'حداکثر تعداد قابل سفارش ۵ عدد است.',
        ];
    }
}
