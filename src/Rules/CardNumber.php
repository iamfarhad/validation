<?php

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;

class CardNumber extends AbstractValidationRule
{
    /**
     * @var string
     */
    public $validationRule = 'card_number';

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function rule($attribute, $value, $parameters, $validator): bool
    {
        if (! preg_match('/^\d{16}$/', $value)) {
            return false;
        }
        $sum = 0;
        for ($position = 1; $position <= 16; $position++) {
            $temp = $value[$position - 1];
            $temp = $position % 2 === 0 ? $temp : $temp * 2;
            $temp = $temp > 9 ? $temp - 9 : $temp;
            $sum += $temp;
        }

        return (bool) ($sum % 10 === 0);
    }
}
