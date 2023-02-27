<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

final class Base64 implements Rule
{
    private ?string $attribute = null;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return base64_encode(base64_decode($value, true)) === $value;
    }

    public function message(): string
    {
        return __('validationRules::messages.base64', [
            'attribute' => $this->attribute,
        ]);
    }
}
