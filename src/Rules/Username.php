<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

final class Username implements Rule
{
    private string $attribute;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return preg_match(
            "#^[a-z][a-z0-9]*(?:[_\-][a-z0-9]+)*$#i",
            $value
        );
    }

    public function message(): string
    {
        return __('validationRules::messages.username', [
            'attribute' => $this->attribute,
        ]);
    }
}
