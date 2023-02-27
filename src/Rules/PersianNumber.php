<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

final class PersianNumber implements Rule
{
    private ?string $attribute = null;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return preg_match('#^[\x{6F0}-\x{6F9}]+$#u', $value);
    }

    public function message(): string
    {
        return __('validationRules::messages.persianNumber', [
            'attribute' => $this->attribute,
        ]);
    }
}
