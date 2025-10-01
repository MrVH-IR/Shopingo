<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
            "permissions"   => "required|array|min:1",
            "permissions.*" => "numeric|exists:permissions,id",
            "status"        => "required|in:0,1",
            "name" => [
                "required",
                "string",
                "min:3",
                "max:255",
                $this->role ? Rule::unique('roles', 'name')->ignore($this->role->id) : 'unique:roles,name',
                ],
            "description"   => "nullable|string|min:3|max:255|regex:/^[\p{Arabic}a-zA-Z0-9\s]+$/u",
        ];
    }

    public function messages(): array
    {
        return [
            "permissions.required"   => "کاربر باید حداقل یک دسترسی داشته باشد",
            "permissions.array"      => "لیست دسترسی‌ها باید به صورت آرایه ارسال شود",
            "permissions.min"        => "حداقل یک دسترسی باید انتخاب شود",
            "permissions.*.numeric"  => "شناسه دسترسی نامعتبر است",
            "permissions.*.exists"   => "دسترسی انتخاب شده در دیتابیس وجود ندارد",

            "name.required"          => "نام نقش الزامی است",
            "name.string"            => "نام نقش باید متن باشد",
            "name.min"               => "نام نقش باید حداقل ۳ کاراکتر باشد",
            "name.max"               => "نام نقش نباید بیشتر از ۲۵۵ کاراکتر باشد",
            "name.unique"            => "این نام نقش قبلاً استفاده شده است",

            "description.string"     => "توضیحات نقش باید متن باشد",
            "description.min"        => "توضیحات نقش باید حداقل ۳ کاراکتر باشد",
            "description.max"        => "توضیحات نقش نباید بیشتر از ۲۵۵ کاراکتر باشد",
            "description.regex"      => "توضیحات فقط می‌تواند شامل حروف، اعداد و فاصله باشد",
        ];
    }
}
