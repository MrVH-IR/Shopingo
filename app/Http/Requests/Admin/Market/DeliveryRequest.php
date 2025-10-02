<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            "name" => "required|string|min:2|max:255|regex:/^[ا-یa-zA-Z0-9\s]+$/u",
            "amount" => "required|numeric|min:0|max:9999999999999999.99|regex:/^\d+(\.\d{1,2})?$/",
            "delivery_time" => "required|integer|min:0|max:999999",
            "delivery_time_unit" => "required|string|regex:/^[ا-یa-zA-Z0-9\s]+$/u",
            "status" => "required|integer|between:0,1",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required"               => "فیلد نام اجباری می‌باشد.",
            "name.string"                 => "فیلد نام باید متنی باشد.",
            "name.min"                    => "نام باید حداقل ۲ کاراکتر باشد.",
            "name.max"                    => "نام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.",
            "name.regex"                  => "نام فقط می‌تواند شامل حروف فارسی، انگلیسی و اعداد باشد.",

            "amount.required"             => "فیلد مبلغ اجباری می‌باشد.",
            "amount.numeric"              => "فیلد مبلغ باید عددی باشد.",
            "amount.min"                  => "مبلغ باید حداقل ۱ باشد.",
            "amount.max"                  => "مبلغ نمی‌تواند بیشتر از ۹۹۹۹۹۹۹۹۹۹۹۹۹۹۹۹.۹۹ باشد.",
            "amount.regex"                => "فیلد مبلغ فقط باید شامل اعداد باشد.",

            "delivery_time.required"      => "فیلد زمان تحویل اجباری می‌باشد.",
            "delivery_time.integer"       => "زمان تحویل باید یک عدد صحیح باشد.",
            "delivery_time.min"           => "زمان تحویل باید حداقل ۱ باشد.",
            "delivery_time.max"           => "زمان تحویل نمی‌تواند بیشتر از ۹۹۹۹۹۹ باشد.",

            "delivery_time_unit.required" => "واحد زمان تحویل اجباری می‌باشد.",
            "delivery_time_unit.string"   => "واحد زمان تحویل باید متنی باشد.",
            "delivery_time_unit.min"      => "واحد زمان تحویل باید حداقل ۲ کاراکتر باشد.",
            "delivery_time_unit.max"      => "واحد زمان تحویل نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.",
            "delivery_time_unit.regex"    => "واحد زمان تحویل فقط می‌تواند شامل حروف فارسی، انگلیسی و اعداد باشد.",

            "status.required"             => "فیلد وضعیت اجباری می باشد",
            "status.between"              => "فیلد وضعیت نا معتبر می باشد",
            "status.integer"              => "فیلد وضعیت نامعتبر می باشد"
        ];
    }
}
