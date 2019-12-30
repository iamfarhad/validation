<?php

/*
 * This file is part of persian validation package
 *
 * (c) Farhad Zand <farhad.pd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Iamfarhad\Validation\Contracts;

interface ValidationRuleInterface
{
    public function rule($attribute, $value, $parameters, $validator): bool;
}
