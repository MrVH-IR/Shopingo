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
        return true;
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
                "name" => ["required", "string", "min:3" , "max:255" , "regex:/[\p{L}\p{N}\s!?_\;\-:.,'\"()]+/u"],
                "description" => ["required", "string", "max:2500" , "regex:/[\p{L}\p{N}\s!?_\;\-:.,'\"()]+/u"],
                "image" => ["required" , "image", "mimes:jpeg,png,jpg,gif,svg", "max:2048"],
                "weight" => ["nullable", "numeric", "min:1" , "max:1000"],
                "length" => ["nullable", "numeric", "min:1" , "max:1000"],
                "width" => ["nullable", "numeric", "min:1" , "max:1000"],
                "height" => ["nullable", "numeric", "min:1" , "max:1000"],
                "price" => ["required", "numeric", "min:0" , "regex:/^[0-9.]+$/u"],
                "status" => ["required", "boolean"],
                "marketable" => ["required", "boolean"],
                "tags" => ["required" , "string" , "max:255"],
                "brand_id" => ["required", "integer", "regex:/^[0-9]+$/u" , "exists:brands,id"],
                "product_categories" => ["required", "integer" , "regex:/^[0-9]+$/u" , "exists:product_categories,id"],
                "published_at" => ["required", "date", "date_format:Y/m/d H:i:s"],
                "meta_key" => ["nullable", "array"],
                "meta_key.*" => ["nullable" ,"string", "max:255", "regex:/^[\p{L}\p{N}\s!?_\;:.]+$/u"],
                "meta_value" => ["nullable", "array"],
                "meta_value.*" => ["nullable","string", "max:255", "regex:/^[\p{L}\p{N}\s!?_\;:.]+$/u"],
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                "name" => ["required", "string", "max:255" , "regex:/[\p{L}\p{N}\s!?_\;\-:.,'\"()]+/u"],
                "description" => ["required", "string", "max:2500" , "regex:/[\p{L}\p{N}\s!?_\;\-:.,'\"()]+/u"],
                "image" => ["nullable" , "image", "mimes:jpeg,png,jpg,gif,svg", "max:2048"],
                "weight" => ["nullable", "numeric", "min:1" , "max:1000"],
                "length" => ["nullable", "numeric", "min:1" , "max:1000"],
                "width" => ["nullable", "numeric", "min:1" , "max:1000"],
                "height" => ["nullable", "numeric", "min:1" , "max:1000"],
                "price" => ["required", "numeric" , "min:0" , "regex:/^[0-9.]+$/u"],
                "status" => ["required", "boolean"],
                "marketable" => ["required", "boolean"],
                "tags" => ["nullable"],
                "brand_id" => ["required", "integer", "exists:brands,id"],
                "product_categories" => ["required", "integer" , "exists:product_categories,id"],
                "published_at" => ["required", "date", "date_format:Y/m/d H:i:s"],
                "meta_key" => ["nullable", "array"],
                "meta_key.*" => ["nullable","string", "max:255", "regex:/^[\p{L}\p{N}\s!?_\;:.]+$/u"],
                "meta_value" => ["nullable", "array"],
                "meta_value.*" => ["nullable","string", "max:255", "regex:/^[\p{L}\p{N}\s!?_\;:.]+$/u"],
            ];
        }
        abort(400);
    }

    public function messages(): array
    {
        return [
            "name.required" => "فیلد نام الزامی می‌باشد.",
            "name.string" => "فیلد نام باید از نوع رشته (متن) باشد.",
            "name.min" => "فیلد نام باید حداقل ۳ کاراکتر باشد.",
            "name.max" => "فیلد نام نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.",
            "name.regex" => "فرمت فیلد نام معتبر نیست. تنها حروف، اعداد و کاراکترهای مجاز مجازند.",

            "description.required" => "توضیحات الزامی است.",
            "description.string" => "توضیحات باید از نوع رشته باشد.",
            "description.max" => "توضیحات نمی‌تواند بیش از ۲۵۰۰ کاراکتر باشد.",
            "description.regex" => "فرمت توضیحات معتبر نیست.",

            "image.required" => "آپلود تصویر الزامی است.",
            "image.image" => "فایل انتخابی باید یک تصویر باشد.",
            "image.mimes" => "فرمت تصویر باید یکی از نوع‌های jpeg, png, jpg, gif, svg باشد.",
            "image.max" => "حجم تصویر نباید بیشتر از ۲ مگابایت باشد.",

            "weight.integer" => "وزن باید عدد صحیح باشد.",
            "weight.min" => "وزن نمی‌تواند کمتر از ۱ باشد.",
            "weight.max" => "وزن نمی‌تواند بیشتر از ۱۰۰۰ باشد.",

            "length.integer" => "طول باید عدد صحیح باشد.",
            "length.min" => "طول نمی‌تواند کمتر از ۱ باشد.",
            "length.max" => "طول نمی‌تواند بیشتر از ۱۰۰۰ باشد.",

            "width.integer" => "عرض باید عدد صحیح باشد.",
            "width.min" => "عرض نمی‌تواند کمتر از ۱ باشد.",
            "width.max" => "عرض نمی‌تواند بیشتر از ۱۰۰۰ باشد.",

            "height.integer" => "ارتفاع باید عدد صحیح باشد.",
            "height.min" => "ارتفاع نمی‌تواند کمتر از ۱ باشد.",
            "height.max" => "ارتفاع نمی‌تواند بیشتر از ۱۰۰۰ باشد.",

            "price.required" => "قیمت الزامی است.",
            "price.numeric" => "قیمت باید عددی باشد.",
            "price.min" => "قیمت نمی‌تواند مقدار منفی یا صفر باشد.",
            "price.regex" => "فرمت قیمت معتبر نیست. فقط اعداد و نقطه مجازند.",

            "status.required" => "وضعیت الزامی است.",
            "status.boolean" => "وضعیت باید از نوع بولین (۰ یا ۱) باشد.",

            "marketable.required" => "وضعیت قابلیت فروش الزامی است.",
            "marketable.boolean" => "قابلیت فروش باید بولین باشد.",

            "tags.required" => "تگ‌ها الزامی هستند.",
            "tags.max" => "حداکثر کاراکتر 255 تا میباشد",
            "tags.string" => "از کاراکتر های غیر مجاز برای تگ استفاده نکنید",
//            "tags.regex" => "از کارکتر های غیر ضروری و غیر مجاز برای نگ استفاده نکنید",

            "brand_id.required" => "انتخاب برند الزامی است.",
            "brand_id.integer" => "شناسه برند باید عددی باشد.",
            "brand_id.exists" => "برند انتخاب شده معتبر نیست.",
            "brand_id.regex" => "فرمت شناسه برند معتبر نیست.",

            "product_categories.required" => "انتخاب دسته‌بندی محصول الزامی است.",
            "product_categories.integer" => "شناسه دسته‌بندی باید عددی باشد.",
            "product_categories.exists" => "دسته‌بندی انتخاب شده معتبر نیست.",
            "product_categories.regex" => "فرمت شناسه دسته‌بندی معتبر نیست.",

            "published_at.required" => "تاریخ انتشار الزامی است.",
            "published_at.date" => "تاریخ انتشار باید معتبر باشد.",
            "published_at.date_format" => "فرمت تاریخ انتشار باید به صورت YYYY-MM-DD باشد.",

            "meta_key.*.max" => "ویژگی بیشتر از 255 کاراکتر نمی تواند باشد",
            "meta_key.*.regex" => "فرمت ویژگی معتبر نیست.",
            "meta_key.*.string" => "باید از نوع رشته باشد.",
            "meta_key.array" => "ویژگی باید لیست باشد",

            "meta_value.*.max" => "مقدار ویژگی بیشتر از 255 کاراکتر نمی تواند باشد",
            "meta_value.*.regex" => "فرمت مقدار ویژگی معتبر نیست.",
            "meta_value.*.string" => "مقدار ویژگی باید از نوع رشته باشد.",
            "meta_value.array" => "مقدار ویژگی باید لیست باشد",
        ];
    }
}
