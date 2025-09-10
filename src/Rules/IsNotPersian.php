<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class IsNotPersian implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail(__('validationRules::messages.isNotPersian', ['attribute' => $attribute]));

            return;
        }

        if (preg_match("#[\x{600}-\x{6FF}]#u", $value)) {
            $fail(__('validationRules::messages.isNotPersian', ['attribute' => $attribute]));
        }
    }
}
