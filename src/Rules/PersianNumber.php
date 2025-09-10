<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class PersianNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail(__('validationRules::messages.persianNumber', ['attribute' => $attribute]));

            return;
        }

        $value = (string) $value;

        if (! preg_match('#^[\x{6F0}-\x{6F9}]+$#u', $value)) {
            $fail(__('validationRules::messages.persianNumber', ['attribute' => $attribute]));
        }
    }
}
