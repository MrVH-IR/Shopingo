<?php

namespace App\Http\Requests\Admin\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketCategoryRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status' => 'required|numeric|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            "name.max" => "حداکثر مقدار نام 120 کاراکتر می باشد",
            "name.min" => "جداقل مقدار نام 2 کاراکتر می باشد",
            "name.regex" => " در استفاده از حروف غیر مجاز ممنوع خودداری کنید",
            "status.numeric" => "فیلد وضعیت باید فعال یا غیر فعال باشد",
            "status.in" => "فیلد وضعیت اشتباه است",
            "status.required" => "فیل وضعیت اجباری است"
        ];
    }
}
