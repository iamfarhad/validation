<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;

class IsNotPersian extends AbstractValidationRule
{
    /**
     * @var string
     */
    public $validationRule = 'is_not_persian';

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
        if (is_string($value)) {
            $this->status = (bool) preg_match("/[\x{600}-\x{6FF}]/u", $value);

            return ! $this->status;
        }

        return false;
    }
}
