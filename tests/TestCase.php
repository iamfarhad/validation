<?php
namespace Iamfarhad\Validation\Tests;

use Iamfarhad\Validation\ValidationRulesServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->reloadApplication();
        $this->app->setLocale(env('locale'));

        //$this->app->setFallbackLocale('fa');
    }

    protected function getPackageProviders($app): array
    {
        return [
            ValidationRulesServiceProvider::class,
        ];
    }

    public function provideLocales(): array
    {
        return [
            "en" => ["en"],
            "fa" => ["fa"],
        ];
    }
}
