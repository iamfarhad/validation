<?php


namespace Iamfarhad\Validation\Rules;


use Iamfarhad\Validation\Contracts\AbstractValidationRule;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class IranPhoneWithArea extends AbstractValidationRule implements ValidationRuleInterface
{
    public $validationRule = 'iran_phone_area';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        return (bool)preg_match('/^(0[1-9]{2})[2-9][0-9]{7}+$/', $value);
    }
}
