<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class Username implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail(__('validationRules::messages.username', ['attribute' => $attribute]));
            return;
        }

        if (! preg_match("#^[a-z][a-z0-9]*(?:[_\-][a-z0-9]+)*$#i", $value)) {
            $fail(__('validationRules::messages.username', ['attribute' => $attribute]));
        }
    }
}
