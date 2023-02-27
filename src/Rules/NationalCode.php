<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

final class NationalCode implements Rule
{
    private ?string $attribute = null;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;
        if (! preg_match('#^\d{8,10}$#', $value)) {
            return false;
        }

        if (preg_match('#^[0]{10}|[1]{10}|[2]{10}|[3]{10}|[4]{10}|[5]{10}|[6]{10}|[7]{10}|[8]{10}|[9]{10}$#', $value)) {
            return false;
        }

        $sub = 0;
        if (strlen($value) == 8) {
            $value = '00'.$value;
        } elseif (strlen($value) == 9) {
            $value = '0'.$value;
        }

        for ($i = 0; $i <= 8; ++$i) {
            $sub += $value[$i] * (10 - $i);
        }

        $control = ($sub % 11) < 2 ? $sub % 11 : 11 - ($sub % 11);
        return $value[9] == $control;
    }

    public function message(): string
    {
        return __('validationRules::messages.nationalCode', [
            'attribute' => $this->attribute,
        ]);
    }
}
