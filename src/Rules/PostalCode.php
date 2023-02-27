<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

final class PostalCode implements Rule
{
    private ?string $attribute = null;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return preg_match("#^(\d{10})$#", $value);
    }

    public function message(): string
    {
        return __('validationRules::messages.postalCode', [
            'attribute' => $this->attribute,
        ]);
    }
}
