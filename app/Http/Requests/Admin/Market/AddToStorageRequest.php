<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class AddToStorageRequest extends FormRequest
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
            "receiver" => "required|string|max:255",
            "deliverer" => "required|string|max:255",
            "marketable_number" => "required|numeric|max:10000",
            "description" => "required|string|max:10000",
        ];
    }

    public function messages(): array
    {
        return [
            "receiver.required" => "نام تحویل گیرنده اجباری می باشد",
            "receiver.string" => "نام تحویل گیرنده باید از نوع کاراکتر باشد",
            "receiver.max" => "حداکثر نام برای تحویل گیرنده 255 کاراکتر می باشد",

            "deliverer.required" => "نام تحویل دهنده اجباری می باشد",
            "deliverer.string" => "نام تحویل دهنده باید از نوع کاراکتر باشد",
            "deliverer.max" => "حداکثر نام برای تحویل دهنده 255 کاراکتر می باشد",

            "marketable_number.required" => "تعداد اضافه شده به انبار اجباری می باشد",
            "marketable_number.numeric" => "مقدار اضافه شده به انبار باید از نوع عدد باشد",
            "marketable_number.max" => "نهایت موجودی کالا در انبار 10000 عدد می باشد",

            "description.required" => "توضیحات اجباری می باشد",
            "description.string" => "توضیحات باید از نوع رشته باشد",
            "description.max" => "بیشترین مقدار توضیحات 10000 کاراکتر می باشد",
        ];
    }
}
