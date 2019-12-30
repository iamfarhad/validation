<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class IsNotPersian extends AbstractValidationRule implements ValidationRuleInterface
{
    public $validationRule = 'is_not_persian';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        if (is_string($value)) {
            $this->status = (bool) preg_match("/[\x{600}-\x{6FF}]/u", $value);

            return !$this->status;
        }

        return false;
    }
}
