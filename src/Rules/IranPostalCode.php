<?php


namespace Iamfarhad\Validation\Rules;


use Iamfarhad\Validation\Contracts\AbstractValidationRule;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class IranPostalCode extends AbstractValidationRule implements ValidationRuleInterface
{
    public $validationRule = 'iran_postal_code';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        return (bool)preg_match("/^(\d{5}-?\d{5})$/", $value);
    }
}
