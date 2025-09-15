<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class PersianAlphaNum implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail(__('validationRules::messages.persianAlphaNum', ['attribute' => $attribute]));
            return;
        }

        if (! preg_match("#^[\x{600}-\x{6FF}\x{6F0}-\x{6F9}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$#u", $value)) {
            $fail(__('validationRules::messages.persianAlphaNum', ['attribute' => $attribute]));
        }
    }
}
