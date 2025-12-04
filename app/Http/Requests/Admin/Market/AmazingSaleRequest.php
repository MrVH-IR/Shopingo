<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class AmazingSaleRequest extends FormRequest
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
            "percentage" => "required|numeric|min:1|max:100",
            "product_id" => "required|numeric:|exists:products,id|regex:/^[0-9]+$/",
            "status" => "required|between:0,1",
            "start_at" => "required|date|date_format:Y/m/d H:i:s",
            "end_at" => "required|date|date_format:Y/m/d H:i:s",
        ];
    }

    public function messages(): array
    {
        return [
            "percentage.min" => "کمترین مقدار درصد تخفیف ۱ می تواند باشد",
            "percentage.max" => "بیشترین مقدار درصد تخفیف ۱۰۰ می تواند باشد",
            "percentage.numeric" => "مقدار تخفیف باید عدد باشد",
            "percentage.required" => "مقدار تخفیف اجباری می باشد",
            "product_id.numeric" => "فرمت محصول اشتباه می باشد",
            "product_id.required" => "محصول را انتخاب کنید",
            "product_id.exists" => "محصول مورد نظر موجود نمی باشد",
            "product_id.regex" => "فرمت محصول درست نمی باشد",
            "status.required" => "وضعیت اجباری می باشد",
            "status.between" => "فرمت وضعیت درست نمی باشد",
            "start_at.required" => "تاریخ شروع اجباری می باشد",
            "start_at.date" => "تاریخ شروع معتبر نمی باشد",
            "start_at.date_format" => "فرمت تاریخ شروع اشتباه می باشد",
            "end_at.required" => "تاریخ شروع اجباری می باشد",
            "end_at.date" => "تاریخ شروع معتبر نمی باشد",
            "end_at.date_format" => "فرمت تاریخ شروع اشتباه می باشد",
        ];
    }
}
