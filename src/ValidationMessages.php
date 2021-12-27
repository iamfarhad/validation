<?php

/*
 * This file is part of persian validation package
 *
 * (c) Farhad Zand <farhad.pd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Iamfarhad\Validation;

use App;

class ValidationMessages
{
    /**
     * @var mixed lang
     */
    public $lang;

    /**
     * ValidationMessages constructor.
     */
    public function __construct()
    {
        $app_lang = resource_path('lang/validation/'.App::getLocale().'.php');

        if (! file_exists($app_lang)) {
            $this->lang = include $app_lang;
        } else {
            $this->lang = include __DIR__.'/lang/validation/'.App::getLocale().'.php';
        }
    }

    /**
     * @param $message
     * @param $attribute
     * @param $rule
     * @return string
     */
    public function message($message, $attribute, $rule): string
    {
        return str_replace($message, $this->lang[$rule], $message);
    }
}
