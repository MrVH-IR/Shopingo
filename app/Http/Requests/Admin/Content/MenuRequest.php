<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            "name"      => "required|string|min:3|max:50|regex:/^[\pL\s\-]+$/u",
            "url"       => "required|string|min:3|max:100|regex:/^[\pL]+(?:-[\pL]+)*$/u",
            "status"    => "required|boolean|in:0,1",
            "parent_id" => "nullable|min:1|max:10000000|numeric|exists:menus,id",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required"     => "فیلد نام اجباری می باشد",
            "name.max"          => "جداکثر نام منو 50 کاراکتر می باشد",
            "name.min"          => "حداقل نام منو 3 کاراکتر می باشد",
            "name.string"       => "در استفاده از کاراکتر های عیر مجاز برای منو خودداری کنید",
            "url.max"           => "حداکثر نام دامنه 100 کاراکتر می باشد",
            "url.min"           => "جداقل نام دامنه 3 کاراکتر می باشد",
            "url.string"        => "در استفاده از کاراکتر های عیر مجاز برای نام دامنه خودداری کنید",
            "url.required"      => "فیلد نام دامنه اجباری می باشد",
            "status.required"   => "فیلد وضعیت اجباری می باشد",
            "status.boolean"    => "فیلد وضعیت فقط می تواند فعال یا غیر فعال باشد",
            "status.in"         => "فیلد وضعیت فقط می تواند 0 یا 1 باشد",
        ];
    }
}
