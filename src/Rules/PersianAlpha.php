<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class PersianAlpha extends AbstractValidationRule implements ValidationRuleInterface
{
    public $validationRule = 'persian_alphabet';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        return (bool) preg_match("/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u", $value);
    }
}
