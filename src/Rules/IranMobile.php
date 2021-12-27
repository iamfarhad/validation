<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;

class IranMobile extends AbstractValidationRule
{
    /**
     * @var string
     */
    public $validationRule = 'iran_mobile';

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function rule($attribute, $value, $parameters, $validator): bool
    {
        if ((bool) preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $value) || (bool) preg_match('/^(9){1}[0-9]{9}+$/', $value)) {
            return true;
        }

        return false;
    }
}
