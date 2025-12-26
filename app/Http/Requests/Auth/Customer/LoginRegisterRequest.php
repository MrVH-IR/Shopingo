<?php

namespace App\Http\Requests\Auth\Customer;

use App\Rules\Customer\Auth\EmailOrMobile;
use Illuminate\Foundation\Http\FormRequest;

class LoginRegisterRequest extends FormRequest
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
            "identify" => ["required" , new EmailOrMobile],
            "confirmed" => ["required"]
        ];
    }

    public function messages(): array
    {
        return [
            "confirmed.required" => "شما باید قوانین و شرایط را بپذیرید",
            "identify.required" => "شماره موباید یا ایمیل الزامی می باشد"
        ];
    }
}
