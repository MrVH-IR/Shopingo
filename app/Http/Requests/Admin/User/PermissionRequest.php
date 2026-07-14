<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'role_id' => 'required|array',
            'role_id.*' => 'exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'role_id.required' => "نقش مورد نظر خود را انتخاب کنید.",
            'role_id.exists'   => "نقش مورد نظر وجود ندارد.",
            'role_id.integer'  => "نوع داده ارسالی نقش اشتباه است."
        ];
    }
}
