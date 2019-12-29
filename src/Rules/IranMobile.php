<?php


namespace Iamfarhad\Validation\Rules;


use Iamfarhad\Validation\Contracts\AbstractValidationRule;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class IranMobile extends AbstractValidationRule implements ValidationRuleInterface
{

    public $validationRule = 'iran_mobile';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        if ((bool) preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $value) || (bool) preg_match('/^(9){1}[0-9]{9}+$/', $value))
            return true;

        return false;
    }
}
