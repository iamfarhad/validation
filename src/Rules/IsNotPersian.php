<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsNotPersian implements Rule
{
    /**
     * @var string
     */
    protected $attribute;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        if (is_string($value)) {
            return !preg_match("/[\x{600}-\x{6FF}]/u", $value);
        }

        return false;
    }

    public function message(): string
    {
        return __('validationRules::messages.isNotPersian', [
            'attribute' => $this->attribute,
        ]);
    }
}
