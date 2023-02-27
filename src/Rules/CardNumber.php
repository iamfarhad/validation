<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

final class CardNumber implements Rule
{
    private ?string $attribute = null;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        if (! preg_match('#^\d{16}$#', $value)) {
            return false;
        }

        $sum = 0;
        for ($position = 1; $position <= 16; ++$position) {
            $temp = $value[$position - 1];
            $temp = $position % 2 === 0 ? $temp : $temp * 2;
            $temp = $temp > 9 ? $temp - 9 : $temp;
            $sum += $temp;
        }

        return $sum % 10 === 0;
    }

    public function message(): string
    {
        return __('validationRules::messages.cardNumber', [
            'attribute' => $this->attribute,
        ]);
    }
}
