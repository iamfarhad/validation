<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class PostalCode implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail(__('validationRules::messages.postalCode', ['attribute' => $attribute]));
            return;
        }

        $value = (string) $value;

        if (! preg_match("#^(\d{10})$#", $value)) {
            $fail(__('validationRules::messages.postalCode', ['attribute' => $attribute]));
        }
    }
}
