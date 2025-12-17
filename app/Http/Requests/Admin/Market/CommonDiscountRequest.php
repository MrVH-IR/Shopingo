<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CommonDiscountRequest extends FormRequest
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
            "title" => "required|string|min:3|max:255|regex:/^[\p{Arabic}A-Za-z0-9\s\-.‌]+$/u",
            "discount" => "required|numeric|min:1|max:100",
            "discount_ceiling" => "required|min:0|max:1000000000|numeric",
            "discount_floor" => "required|min:0|max:1000000000|numeric",
            "status" => "required|in:0,1|numeric",
            "start_date" => "required|date|date_format:Y/m/d H:i:s",
            "end_date" => "required|date|date_format:Y/m/d H:i:s|after_or_equal:start_date",
        ];
    }

    public function messages(): array
    {
        return [

            // title
            'title.required' => 'عنوان الزامی است.',
            'title.string'   => 'عنوان باید به صورت متن وارد شود.',
            'title.min'      => 'عنوان باید حداقل ۳ کاراکتر باشد.',
            'title.max'      => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'title.regex'    => 'عنوان فقط می‌تواند شامل حروف فارسی یا انگلیسی، فاصله، خط تیره و نقطه باشد.',

            // discount
            'discount.required' => 'درصد تخفیف الزامی است.',
            'discount.numeric'  => 'درصد تخفیف باید عددی باشد.',
            'discount.min'      => 'درصد تخفیف باید حداقل ۱ درصد باشد.',
            'discount.max'      => 'درصد تخفیف نمی‌تواند بیشتر از ۱۰۰ درصد باشد.',

            // discount_ceiling
            'discount_ceiling.required' => 'سقف تخفیف الزامی است.',
            'discount_ceiling.numeric'  => 'سقف تخفیف باید عددی باشد.',
            'discount_ceiling.min'      => 'سقف تخفیف نمی‌تواند کمتر از صفر باشد.',
            'discount_ceiling.max'      => 'سقف تخفیف بیش از حد مجاز است.',

            // discount_floor
            'discount_floor.required' => 'کف تخفیف الزامی است.',
            'discount_floor.numeric'  => 'کف تخفیف باید عددی باشد.',
            'discount_floor.min'      => 'کف تخفیف نمی‌تواند کمتر از صفر باشد.',
            'discount_floor.max'      => 'کف تخفیف بیش از حد مجاز است.',

            // status
            'status.required' => 'وضعیت الزامی است.',
            'status.in'       => 'وضعیت انتخاب شده نامعتبر است.',
            'status.numeric'  => 'وضعیت باید به صورت عددی ارسال شود.',

            // start_date
            'start_date.required'    => 'تاریخ شروع الزامی است.',
            'start_date.date'        => 'فرمت تاریخ شروع معتبر نیست.',
            'start_date.date_format' => 'فرمت تاریخ شروع باید به صورت YYYY/MM/DD HH:MM:SS باشد.',

            // end_date
            'end_date.required'    => 'تاریخ پایان الزامی است.',
            'end_date.date'        => 'فرمت تاریخ پایان معتبر نیست.',
            'end_date.date_format' => 'فرمت تاریخ پایان باید به صورت YYYY/MM/DD HH:MM:SS باشد.',
            'end_date.after_or_equal' => 'تاریخ پایان باید بعد از یا برابر با تاریخ شروع باشد.',
        ];
    }
}
