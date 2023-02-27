<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

final class Phone implements Rule
{
    private ?string $attribute = null;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return preg_match('#^[2-9]\d{7}+$#', $value);
    }

    public function message(): string
    {
        return __('validationRules::messages.phone', [
            'attribute' => $this->attribute,
        ]);
    }
}
