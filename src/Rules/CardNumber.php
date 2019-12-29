<?php


namespace Iamfarhad\Validation\Rules;


use Iamfarhad\Validation\Contracts\AbstractValidationRule;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class CardNumber extends AbstractValidationRule implements ValidationRuleInterface
{
    public $validationRule = 'card_number';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        if (!preg_match('/^\d{16}$/', $value)) {
            return false;
        }
        $sum = 0;
        for ($position = 1; $position <= 16; $position++) {
            $temp = $value[$position - 1];
            $temp = $position % 2 === 0 ? $temp : $temp * 2;
            $temp = $temp > 9 ? $temp - 9 : $temp;
            $sum += $temp;
        }
        return (bool)($sum % 10 === 0);
    }
}
