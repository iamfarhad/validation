<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;

class IranPostalCode extends AbstractValidationRule
{
    public $validationRule = 'iran_postal_code';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        return (bool) preg_match("/^(\d{5}-?\d{5})$/", $value);
    }
}
