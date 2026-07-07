<?php

namespace Common\Services\SalesProcess\Request;

use Common\Controllers\SalesProcess\Rule\PostalCode;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
        $rules = [
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|min:3|max:1500',
            'postal_code' => ['required', new PostalCode(), 'min:7', 'max:22'],
            'no' => 'required|numeric',
            'unit' => 'required|numeric',
            'receiver' => 'sometimes|in:on,off',
            'recipient_first_name' => 'required_if:receiver,off',
            'recipient_last_name' => 'required_if:receiver,off',
            'mobile' => 'required_if:receiver,off',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['id'] = 'required|exists:addresses,id';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'province_id.required' => 'انتخاب استان الزامی است',
            'province_id.exists' => 'استان انتخاب شده معتبر نیست',

            'city_id.required' => 'انتخاب شهر الزامی است',
            'city_id.exists' => 'شهر انتخاب شده معتبر نیست',

            'address.required' => 'وارد کردن آدرس الزامی است',
            'address.string' => 'آدرس باید به صورت متن باشد',
            'address.min' => 'آدرس باید حداقل ۳ کاراکتر باشد',
            'address.max' => 'آدرس نباید بیشتر از ۱۵۰۰ کاراکتر باشد',

            'postal_code.required' => 'وارد کردن کد پستی الزامی است',
            'postal_code.min' => 'کد پستی باید حداقل ۷ کاراکتر باشد',
            'postal_code.max' => 'کد پستی نباید بیشتر از ۲۲ کاراکتر باشد',

            'no.required' => 'وارد کردن شماره پلاک الزامی است',
            'no.numeric' => 'شماره پلاک باید عدد باشد',

            'unit.required' => 'وارد کردن شماره واحد الزامی است',
            'unit.numeric' => 'شماره واحد باید عدد باشد',

            'receiver.sometimes' => 'وضعیت گیرنده نامعتبر است',
            'recipient_first_name.required_if' => 'وارد کردن نام گیرنده هنگام فعال بودن گزینه "گیرنده" الزامی است',
            'recipient_last_name.required_if' => 'وارد کردن نام خانوادگی گیرنده هنگام فعال بودن گزینه "گیرنده" الزامی است',

            'mobile.required_if' => 'وارد کردن شماره موبایل گیرنده هنگام فعال بودن گزینه "گیرنده" الزامی است',
        ];
    }
}
