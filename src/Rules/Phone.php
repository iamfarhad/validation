<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
{
    /**
     * @var string
     */
    protected $attribute;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return preg_match('/^[2-9][0-9]{7}+$/', $value);
    }

    public function message(): string
    {
        return __('validationRules::messages.phone', [
            'attribute' => $this->attribute,
        ]);
    }
}
