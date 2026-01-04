<?php

namespace App\Http\Requests\Auth\Customer;

use Illuminate\Foundation\Http\FormRequest;

class LoginConfirmRequest extends FormRequest
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
            "code" => "required|min:7|max:7",
        ];
    }

    public function messages(): array
    {
        return [
            "code.max" => "کد ارسالی ۷ رقم می باشد",
            "code.min" => "کد نباید کمتر از ۷ رقم باشد",
            "code.required" => "کد ارسالی رو وارد کنید"
        ];
    }
}
