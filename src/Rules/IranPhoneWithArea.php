<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;

class IranPhoneWithArea extends AbstractValidationRule
{
    /**
     * @var string
     */
    public $validationRule = 'iran_phone_area';

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function rule($attribute, $value, $parameters, $validator): bool
    {
        return (bool) preg_match('/^(0[1-9]{2})[2-9][0-9]{7}+$/', $value);
    }
}
