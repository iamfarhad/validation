<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class Domain implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || empty($value)) {
            $fail(__('validationRules::messages.domain', ['attribute' => $attribute]));
            return;
        }

        // Remove protocol if present
        $domain = preg_replace('#^https?://#i', '', $value);

        // Remove path if present
        $domain = explode('/', $domain)[0];

        // Check if domain has at least one dot (except for localhost)
        if ($domain !== 'localhost' && strpos($domain, '.') === false) {
            $fail(__('validationRules::messages.domain', ['attribute' => $attribute]));
            return;
        }

        // Validate domain format
        if (! preg_match('/^(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?\.)*[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?$/', $domain)) {
            $fail(__('validationRules::messages.domain', ['attribute' => $attribute]));
            return;
        }

        // Check for valid TLD (at least 2 characters after last dot)
        $parts = explode('.', $domain);
        if (count($parts) > 1) {
            $tld = end($parts);
            if (strlen($tld) < 2) {
                $fail(__('validationRules::messages.domain', ['attribute' => $attribute]));
            }
        }
    }
}
