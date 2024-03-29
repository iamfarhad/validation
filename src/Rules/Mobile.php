<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

final class Mobile implements Rule
{
    private ?string $attribute = null;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return preg_match('#^((0)(9){1}\d{9})+$#', $value);
    }

    public function message(): string
    {
        return __('validationRules::messages.mobile', [
            'attribute' => $this->attribute,
        ]);
    }
}
