<?php

namespace App\Rules\Customer\Auth;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailOrMobile implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {

            if (strlen($value) > 64) {
                $fail('فیلد نباید بیشتر از ۶۴ کاراکتر باشد.');
                return;
            }

            return;
        } elseif (preg_match('/^09\d{9}$/', $value)) {
            return;
        }

        $fail('فیلد باید ایمیل معتبر یا شماره موبایل به فرمت 09123456789 باشد.');
    }
}
