<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if($this->isMethod('POST')) {
            return [
                "name" => ["required", "string", "min:3" , "max:255"],
                "description" => ["required", "string", "max:2500"],
                "image" => ["required" , "image", "mimes:jpeg,png,jpg,gif,svg", "max:2048"],
                "weight" => ["nullable", "integer", "min:1" , "max:1000"],
                "length" => ["nullable", "integer", "min:1" , "max:1000"],
                "width" => ["nullable", "integer", "min:1" , "max:1000"],
                "height" => ["nullable", "integer", "min:1" , "max:1000"],
                "price" => ["required", "numeric", "min:0" , "regex:/^[0-9.]+$/u"],
                "status" => ["required", "boolean"],
                "marketable" => ["required", "boolean"],
                "tags" => ["required", "array"],
                "brand_id" => ["required", "integer", "regex:/^[0-9]+$/u" , "exists:brands,id"],
                "product_categories" => ["required", "integer" , "regex:/^[0-9]+$/u" , "exists:product_categories,id"],
                "published_at" => ["required", "date", "date_format:Y-m-d"],
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                "name" => ["required", "string", "max:255"],
                "description" => ["required", "string", "max:2500"],
                "image" => ["nullable" , "image", "mimes:jpeg,png,jpg,gif,svg", "max:2048"],
                "weight" => ["nullable", "integer", "min:1" , "max:1000"],
                "length" => ["nullable", "integer", "min:1" , "max:1000"],
                "width" => ["nullable", "integer", "min:1" , "max:1000"],
                "height" => ["nullable", "integer", "min:1" , "max:1000"],
                "price" => ["required", "numeric" , "min:0" , "regex:/^[0-9.]+$/u"],
                "status" => ["required", "boolean"],
                "marketable" => ["required", "boolean"],
                "tags" => ["nullable", "array"],
                "brand_id" => ["required", "integer", "exists:brands,id"],
                "product_categories" => ["required", "integer" , "exists:product_categories,id"],
                "published_at" => ["required", "date", "date_format:Y-m-d"],
            ];
        }
        abort(400);
    }

    public function messages(): array {
        return [
            "name.required" => "فیلد نام الزامی می باشد",
            "name.max" => "فیلد نام نم تواند بیش از 255 کاراکتر باشد",
            "name.min" => "فیلد نام نمی تواند کمتر از 3 کاراکتر باشد"
        ];
    }
}
