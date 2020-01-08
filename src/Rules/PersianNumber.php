<?php

/*
 * This file is part of persian validation package
 *
 * (c) Farhad Zand <farhad.pd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Iamfarhad\Validation\Rules;

use Iamfarhad\Validation\Contracts\AbstractValidationRule;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class PersianNumber extends AbstractValidationRule
{
    public $validationRule = 'persian_number';

    public function rule($attribute, $value, $parameters, $validator): bool
    {
        return preg_match('/^[\x{6F0}-\x{6F9}]+$/u', $value);
    }
}
