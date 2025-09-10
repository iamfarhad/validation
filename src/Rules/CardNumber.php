<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class CardNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail(__('validationRules::messages.cardNumber', ['attribute' => $attribute]));

            return;
        }

        $value = (string) $value;

        if (! preg_match('#^\d{16}$#', $value)) {
            $fail(__('validationRules::messages.cardNumber', ['attribute' => $attribute]));

            return;
        }

        $sum = 0;
        for ($position = 1; $position <= 16; $position++) {
            $temp = (int) $value[$position - 1];
            $temp = $position % 2 === 0 ? $temp : $temp * 2;
            $temp = $temp > 9 ? $temp - 9 : $temp;
            $sum += $temp;
        }

        if ($sum % 10 !== 0) {
            $fail(__('validationRules::messages.cardNumber', ['attribute' => $attribute]));
        }
    }
}
