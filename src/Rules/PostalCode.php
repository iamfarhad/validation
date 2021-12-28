<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class PostalCode implements Rule
{
    /**
     * @var string
     */
    protected $attribute;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return preg_match("/^(\d{10})$/", $value);
    }

    public function message(): string
    {
        return __('validationRules::messages.postalCode', [
            'attribute' => $this->attribute,
        ]);
    }
}
