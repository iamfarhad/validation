<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class ShebaNumber extends AbstractValidationRule
{
    public $validationRule = 'sheba_number';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        $ibanReplaceValues = [];

        if (empty($value)) {
            return false;
        }

        $value = preg_replace('/[\W_]+/', '', strtoupper($value));
        if ((4 > strlen($value) || strlen($value) > 34) || (is_numeric($value[0]) || is_numeric($value[1])) || (! is_numeric($value[2]) || ! is_numeric($value[3]))) {
            return false;
        }
        $ibanReplaceChars = range('A', 'Z');
        foreach (range(10, 35) as $tempvalue) {
            $ibanReplaceValues[] = strval($tempvalue);
        }
        $tmpIBAN = substr($value, 4).substr($value, 0, 4);
        $tmpIBAN = str_replace($ibanReplaceChars, $ibanReplaceValues, $tmpIBAN);
        $tmpValue = intval(substr($tmpIBAN, 0, 1));
        for ($i = 1; $i < strlen($tmpIBAN); $i++) {
            $tmpValue *= 10;
            $tmpValue += intval(substr($tmpIBAN, $i, 1));
            $tmpValue %= 97;
        }
        if ($tmpValue != 1) {
            return false;
        }

        return true;
    }
}
