<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class CompanyId implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail(__('validationRules::messages.companyId', ['attribute' => $attribute]));
            return;
        }

        $value = (string) $value;

        if (! preg_match('#^\d{11}$#', $value)) {
            $fail(__('validationRules::messages.companyId', ['attribute' => $attribute]));
            return;
        }

        // Check for all zeros or all same digits
        if (preg_match('#^([0-9])\1{10}$#', $value)) {
            $fail(__('validationRules::messages.companyId', ['attribute' => $attribute]));
            return;
        }

        // For now, we'll validate format only - checksum algorithm can be added later
        // Basic validation passed if we reach here
    }
}
