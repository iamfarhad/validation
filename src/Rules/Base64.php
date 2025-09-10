<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class Base64 implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail(__('validationRules::messages.base64', ['attribute' => $attribute]));
            return;
        }

        if (base64_encode(base64_decode($value, true)) !== $value) {
            $fail(__('validationRules::messages.base64', ['attribute' => $attribute]));
        }
    }
}
