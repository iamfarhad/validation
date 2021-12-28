<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Address implements Rule
{
    /**
     * @var string
     */
    protected $attribute;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return preg_match("/^[\pL\s\d\-\/\,\،\.\\\\\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\x{6F0}-\x{6F9}]+$/u",
            $value);
    }

    public function message(): string
    {
        return __('validationRules::messages.address', [
            'attribute' => $this->attribute,
        ]);
    }
}
