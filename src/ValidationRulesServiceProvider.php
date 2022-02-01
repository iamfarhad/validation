<?php

namespace Iamfarhad\Validation;

use Illuminate\Support\ServiceProvider;

class ValidationRulesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../resources/lang' => app()->langPath() . '/vendor/validationRules',
        ]);

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'validationRules');
    }
}
