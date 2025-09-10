<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class Sheba implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail(__('validationRules::messages.shebaNumber', ['attribute' => $attribute]));
            return;
        }

        $value = (string) $value;

        if (empty($value)) {
            $fail(__('validationRules::messages.shebaNumber', ['attribute' => $attribute]));
            return;
        }

        $value = preg_replace('#[\W_]+#', '', strtoupper($value));

        if (strlen($value) < 4 || strlen($value) > 34) {
            $fail(__('validationRules::messages.shebaNumber', ['attribute' => $attribute]));
            return;
        }

        // Check first two characters are letters
        if (is_numeric($value[0]) || is_numeric($value[1])) {
            $fail(__('validationRules::messages.shebaNumber', ['attribute' => $attribute]));
            return;
        }

        // Check next two characters are numbers
        if (! is_numeric($value[2]) || ! is_numeric($value[3])) {
            $fail(__('validationRules::messages.shebaNumber', ['attribute' => $attribute]));
            return;
        }

        $ibanReplaceChars = range('A', 'Z');
        $ibanReplaceValues = [];

        foreach (range(10, 35) as $tempvalue) {
            $ibanReplaceValues[] = (string) $tempvalue;
        }

        $tmpIBAN = substr($value, 4) . substr($value, 0, 4);
        $tmpIBAN = str_replace($ibanReplaceChars, $ibanReplaceValues, $tmpIBAN);

        $tmpValue = (int) $tmpIBAN[0];

        for ($i = 1, $iMax = strlen($tmpIBAN); $i < $iMax; ++$i) {
            $tmpValue *= 10;
            $tmpValue += (int) $tmpIBAN[$i];
            $tmpValue %= 97;
        }

        if ($tmpValue !== 1) {
            $fail(__('validationRules::messages.shebaNumber', ['attribute' => $attribute]));
        }
    }
}
