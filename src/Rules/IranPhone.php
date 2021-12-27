<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;

class IranPhone extends AbstractValidationRule
{
    /**
     * @var string
     */
    public $validationRule = 'iran_phone';

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function rule($attribute, $value, $parameters, $validator): bool
    {
        return (bool) preg_match('/^[2-9][0-9]{7}+$/', $value);
    }
}
