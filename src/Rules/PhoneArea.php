<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneArea implements Rule
{
    /**
     * @var string
     */
    protected $attribute;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return preg_match('/^(0[1-9]{2})[2-9][0-9]{7}+$/', $value);
    }

    public function message(): string
    {
        return __('validationRules::messages.phoneArea', [
            'attribute' => $this->attribute,
        ]);
    }
}
