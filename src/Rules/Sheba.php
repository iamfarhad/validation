<?php

namespace Iamfarhad\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Sheba implements Rule
{
    /**
     * @var string
     */
    protected $attribute;

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        $ibanReplaceValues = [];

        if (! empty($value)) {
            $value = preg_replace('/[\W_]+/', '', strtoupper($value));

            if ((4 > strlen($value) || strlen($value) > 34) || (is_numeric($value [ 0 ]) || is_numeric($value [ 1 ])) || (! is_numeric($value [ 2 ]) || ! is_numeric($value [ 3 ]))) {
                return false;
            }

            $ibanReplaceChars = range('A', 'Z');

            foreach (range(10, 35) as $tempvalue) {
                $ibanReplaceValues[] = (string)$tempvalue;
            }


            $tmpIBAN = substr($value, 4) . substr($value, 0, 4);

            $tmpIBAN = str_replace($ibanReplaceChars, $ibanReplaceValues, $tmpIBAN);

            $tmpValue = (int)$tmpIBAN[0];

            for ($i = 1, $iMax = strlen($tmpIBAN); $i < $iMax; $i++) {
                $tmpValue *= 10;

                $tmpValue += (int)$tmpIBAN[$i];

                $tmpValue %= 97;
            }

            if ($tmpValue != 1) {
                return false;
            }

            return true;
        }

        return false;
    }

    public function message(): string
    {
        return __('validationRules::messages.shebaNumber', [
            'attribute' => $this->attribute,
        ]);
    }
}
