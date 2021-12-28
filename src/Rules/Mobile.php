<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Mobile implements Rule
{
    /**
     * @var string
     */
    protected $attribute;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return preg_match('/^((0)(9){1}[0-9]{9})+$/', $value);
    }

    public function message(): string
    {
        return __('validationRules::messages.mobile', [
            'attribute' => $this->attribute,
        ]);
    }
}
