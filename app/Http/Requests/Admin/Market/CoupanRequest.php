<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CoupanRequest extends FormRequest
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
            "code" => "required|string|min:2|max:100",
            "amount" => [(request()->amount_type == 0) ? "max:100" : "" , "numeric" , "required"],
            "amount_type" => "required|in:0,1",
            "discount_ceiling" => "required|min:0|max:1000000000|numeric",
            "type" => "required|in:0,1|numeric",
            "status" => "required|in:0,1",
            "start_date" => "required|date|date_format:Y/m/d H:i:s",
            "end_date" => "required|date|date_format:Y/m/d H:i:s",
            "user_id" => "required_if:type,1|nullable|exists:users,id|numeric|regex:/^[0-9]+$/",
            ];
    }

    public function messages(): array
    {
        return [
            "code.required" => "لطفاً کد کوپن را وارد کنید.",
            "code.string"   => "کد کوپن باید از نوع رشته باشد.",
            "code.min"      => "کد کوپن باید حداقل ۲ کاراکتر باشد.",
            "code.max"      => "کد کوپن نمی‌تواند بیشتر از ۱۰۰ کاراکتر باشد.",

            "amount.required" => " مقدار تخفیف را وارد کنید.",
            "amount.numeric"  => "میزان تخفیف باید عددی باشد.",
            "amount.max"      => "در حالت درصدی، مقدار نمی‌تواند بیشتر از ۱۰۰ باشد.",

            "amount_type.required" => "نوع تخفیف را انتخاب کنید.",
            "amount_type.in"       => "نوع تخفیف نامعتبر است (درصدی یا عددی).",

            "discount_ceiling.required" => "حداکثر میزان تخفیف را وارد کنید.",
            "discount_ceiling.numeric"  => "حداکثر تخفیف باید عددی باشد.",
            "discount_ceiling.min"      => "حداکثر تخفیف نمی‌تواند کمتر از ۰ باشد.",
            "discount_ceiling.max"      => "حداکثر تخفیف خیلی بزرگ است (حداکثر ۱ میلیارد).",

            "type.required" => "نوع کوپن (عمومی/خصوصی) را انتخاب کنید.",
            "type.in"       => "نوع کوپن معتبر نیست.",
            "type.numeric"  => "نوع کوپن باید عددی باشد.",

            "status.required" => "وضعیت کوپن را مشخص کنید.",
            "status.numeric"  => "وضعیت باید عددی باشد.",
            "status.in"       => "وضعیت نامعتبر است.",

            "start_date.required"    => "تاریخ شروع را وارد کنید.",
            "start_date.date"        => "تاریخ شروع معتبر نیست.",
            "start_date.date_format" => "فرمت تاریخ شروع اشتباه است. (Y/m/d H:i:s)",

            "end_date.required"    => "تاریخ پایان را وارد کنید.",
            "end_date.date"        => "تاریخ پایان معتبر نیست.",
            "end_date.date_format" => "فرمت تاریخ پایان اشتباه است. (Y/m/d H:i:s)",

            "user_id.required_if" => "کاربر باید در صورت خصوصی بودن کد انتخاب شود.",
            "user_id.exists"   => "کاربر انتخاب‌شده وجود ندارد.",
            "user_id.numeric"  => "شناسه کاربر باید عددی باشد.",
            "user_id.regex"    => "شناسه کاربر فقط باید شامل اعداد باشد.",
        ];
    }
}
