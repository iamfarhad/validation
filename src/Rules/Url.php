<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class Url implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || empty($value)) {
            $fail(__('validationRules::messages.url', ['attribute' => $attribute]));
            return;
        }

        if (! filter_var($value, FILTER_VALIDATE_URL)) {
            $fail(__('validationRules::messages.url', ['attribute' => $attribute]));
        }
    }
}
