<?php

namespace Common\Services\Payment\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChooseAddressAndDeliveryRequest extends FormRequest
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
            'address' => ['required', 'integer', Rule::exists('addresses', 'id')->where('user_id', auth()->id())],
            'delivery_type' => ['required', 'integer', 'exists:deliveries,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'address.exists' => 'آدرس مورد نظر پیدا نشد',
            'address.required' => 'آدرس مورد نظر را وارد کنید',

            'delivery_type.required' => 'نحوه ارسال را وارد کنید',
            'delivery_type.exists' => 'نحوه ارسال پیدا نشد.'
        ];
    }
}
