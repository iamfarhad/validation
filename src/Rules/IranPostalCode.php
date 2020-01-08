<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;

class IranPostalCode extends AbstractValidationRule
{
    /**
     * @var string
     */
    public $validationRule = 'iran_postal_code';

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     *
     * @return bool
     */
    public function rule($attribute, $value, $parameters, $validator): bool
    {
        return (bool) preg_match("/^(\d{5}-?\d{5})$/", $value);
    }
}
