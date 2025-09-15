<?php

namespace Iamfarhad\Validation\Tests;

use Iamfarhad\Validation\ValidationServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->app->setLocale(env('locale'));
    }

    protected function getPackageProviders($app): array
    {
        return [
            ValidationServiceProvider::class,
        ];
    }
}
