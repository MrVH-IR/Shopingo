<?php

namespace Common\Services\SalesProcess\Rule;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PostalCode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = convertPersianToEnglish($value);
        $pattern = '/^(?!(\d)\1{9})[1-9]\d{9}$/';

        if (!preg_match($pattern, $value)) {
            $fail(':attribute معتبر نمی‌باشد');
        }
    }
}
