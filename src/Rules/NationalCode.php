<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class NationalCode implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail(__('validationRules::messages.nationalCode', ['attribute' => $attribute]));

            return;
        }

        $value = (string) $value;

        if (! preg_match('#^\d{8,10}$#', $value)) {
            $fail(__('validationRules::messages.nationalCode', ['attribute' => $attribute]));

            return;
        }

        if (preg_match('#^[0]{10}|[1]{10}|[2]{10}|[3]{10}|[4]{10}|[5]{10}|[6]{10}|[7]{10}|[8]{10}|[9]{10}$#', $value)) {
            $fail(__('validationRules::messages.nationalCode', ['attribute' => $attribute]));

            return;
        }

        $sub = 0;
        if (strlen($value) == 8) {
            $value = '00'.$value;
        } elseif (strlen($value) == 9) {
            $value = '0'.$value;
        }

        for ($i = 0; $i <= 8; $i++) {
            $sub += $value[$i] * (10 - $i);
        }

        $control = ($sub % 11) < 2 ? $sub % 11 : 11 - ($sub % 11);

        if ($value[9] != $control) {
            $fail(__('validationRules::messages.nationalCode', ['attribute' => $attribute]));
        }
    }
}
