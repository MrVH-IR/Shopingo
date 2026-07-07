<?php

namespace Common\Services\SalesProcess\Rule;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CheckNationalCode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $bannedArray = [
            '0000000000', '1111111111', '2222222222', '3333333333', '4444444444',
            '5555555555', '6666666666', '7777777777', '8888888888', '9999999999',
        ];

        if (empty($value)) {
            $fail(':attribute نمی‌تواند خالی باشد');
            return;
        }

        if (strlen($value) !== 10 || !ctype_digit($value)) {
            $fail(':attribute باید ۱۰ رقم انگلیسی باشد');
            return;
        }

        if (in_array($value, $bannedArray, true)) {
            $fail(':attribute نادرست است');
            return;
        }

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $value[$i] * (10 - $i);
        }

        $remainder = $sum % 11;
        $checkDigit = $remainder < 2 ? $remainder : 11 - $remainder;

        if ((int) $value[9] !== $checkDigit) {
            $fail(':attribute نادرست است');
        }
    }
}
