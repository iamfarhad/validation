<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class MelliCode extends AbstractValidationRule implements ValidationRuleInterface
{
    public $validationRule = 'melli_code';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        if (! preg_match('/^\d{8,10}$/', $value) || preg_match('/^[0]{10}|[1]{10}|[2]{10}|[3]{10}|[4]{10}|[5]{10}|[6]{10}|[7]{10}|[8]{10}|[9]{10}$/', $value)) {
            return false;
        }
        $sub = 0;
        if (strlen($value) == 8) {
            $value = '00'.$value;
        } elseif (strlen($value) == 9) {
            $value = '0'.$value;
        }

        for ($i = 0; $i <= 8; $i++) {
            $sub = $sub + ($value[$i] * (10 - $i));
        }

        if (($sub % 11) < 2) {
            $control = ($sub % 11);
        } else {
            $control = 11 - ($sub % 11);
        }

        if ($value[9] == $control) {
            return true;
        }

        return false;
    }
}
