<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class IranAddress extends AbstractValidationRule
{
    public $validationRule = 'iran_address';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        return (bool) preg_match("/^[\pL\s\d\-\/\,\،\.\\\\\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\x{6F0}-\x{6F9}]+$/u",
            $value);
    }
}
