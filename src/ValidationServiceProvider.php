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

use Iamfarhad\Validation\Contracts\ValidationRuleInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ValidationMessages', 'Iamfarhad\Validation\ValidationMessages');
    }

    /**
     * Bootstrap services.
     *
     * @throws \ReflectionException
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/lang/validation/'.App::getLocale().'.php' => resource_path('lang/validation/'.App::getLocale().'.php'),
        ]);

        foreach (glob(__DIR__.'/Rules/*.php') as $file) {
            require_once $file;

            // get the file name of the current file without the extension
            // which is essentially the class name
            $class = basename($file, '.php');

            $Rule = 'Iamfarhad\Validation\Rules';
            if (class_exists($Rule.'\\'.$class)) {
                $reflectionClass = new \ReflectionClass($Rule.'\\'.$class);
                if (! $reflectionClass->implementsInterface(ValidationRuleInterface::class)) {
                    throw new \Exception('this extenstion is not instance of ValidationRuleInterface');
                }
                $module = $reflectionClass->newInstanceArgs([]);
                $module->register();
            }
        }
    }
}
