<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class IranPhone extends AbstractValidationRule
{
    public $validationRule = 'iran_phone';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        return (bool) preg_match('/^[2-9][0-9]{7}+$/', $value);
    }
}
