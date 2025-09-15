<?php

namespace Iamfarhad\Validation;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Iamfarhad\Validation\Rules\{
    Address,
    Base64,
    CardNumber,
    CompanyId,
    Domain,
    IsNotPersian,
    Mobile,
    NationalCode,
    PersianAlpha,
    PersianAlphaEngNum,
    PersianAlphaNum,
    PersianNumber,
    Phone,
    PhoneArea,
    PostalCode,
    ShamsiDate,
    ShamsiDateBetween,
    Sheba,
    Url,
    Username
};

class ValidationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/lang' => app()->langPath() . '/vendor/validationRules',
        ]);

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', 'validationRules');

        // Register string-based validation rules
        $this->registerValidationRules();
    }

    private function registerValidationRules(): void
    {
        // Helper method to properly handle validation
        $validateRule = function ($ruleInstance) {
            return function ($attribute, $value, $parameters) use ($ruleInstance) {
                $failed = false;
                $ruleInstance->validate($attribute, $value, function () use (&$failed) {
                    $failed = true;
                });
                return !$failed;
            };
        };

        // Simple rules without parameters
        Validator::extend('persian_alpha', $validateRule(new PersianAlpha()));
        Validator::extend('persian_number', $validateRule(new PersianNumber()));

        Validator::extend('persian_alpha_num', $validateRule(new PersianAlphaNum()));
        Validator::extend('persian_alpha_eng_num', $validateRule(new PersianAlphaEngNum()));
        Validator::extend('ir_national_code', $validateRule(new NationalCode()));
        Validator::extend('ir_mobile', $validateRule(new Mobile()));
        Validator::extend('ir_phone', $validateRule(new Phone()));
        Validator::extend('ir_phone_area', $validateRule(new PhoneArea()));
        Validator::extend('ir_postal_code', $validateRule(new PostalCode()));
        Validator::extend('ir_company_id', $validateRule(new CompanyId()));
        Validator::extend('ir_sheba', $validateRule(new Sheba()));
        Validator::extend('ir_bank_card', $validateRule(new CardNumber()));
        Validator::extend('domain', $validateRule(new Domain()));
        Validator::extend('url_format', $validateRule(new Url()));
        Validator::extend('username_format', $validateRule(new Username()));
        Validator::extend('base64_format', $validateRule(new Base64()));
        Validator::extend('address_format', $validateRule(new Address()));
        Validator::extend('is_not_persian', $validateRule(new IsNotPersian()));

        // Parameterized rules
        Validator::extend('shamsi_date', function ($attribute, $value, $parameters) {
            $separator = $parameters[0] ?? '/';
            $convertPersianNumbers = isset($parameters[1]) ? (bool) $parameters[1] : false;
            $failed = false;
            (new ShamsiDate($separator, $convertPersianNumbers))->validate($attribute, $value, function () use (&$failed) {
                $failed = true;
            });
            return !$failed;
        });

        Validator::extend('shamsi_date_between', function ($attribute, $value, $parameters) {
            $startYear = (int) ($parameters[0] ?? 1300);
            $endYear = (int) ($parameters[1] ?? 1500);
            $separator = $parameters[2] ?? '/';
            $convertPersianNumbers = isset($parameters[3]) ? (bool) $parameters[3] : false;
            $failed = false;
            (new ShamsiDateBetween($startYear, $endYear, $separator, $convertPersianNumbers))->validate($attribute, $value, function () use (&$failed) {
                $failed = true;
            });
            return !$failed;
        });

        // Register custom error messages
        Validator::replacer('persian_alpha', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.persianAlpha', ['attribute' => $attribute]);
        });

        Validator::replacer('persian_number', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.persianNumber', ['attribute' => $attribute]);
        });

        Validator::replacer('persian_alpha_num', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.persianAlphaNum', ['attribute' => $attribute]);
        });

        Validator::replacer('persian_alpha_eng_num', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.persianAlphaEngNum', ['attribute' => $attribute]);
        });

        Validator::replacer('ir_national_code', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.nationalCode', ['attribute' => $attribute]);
        });

        Validator::replacer('ir_mobile', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.mobile', ['attribute' => $attribute]);
        });

        Validator::replacer('ir_phone', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.phone', ['attribute' => $attribute]);
        });

        Validator::replacer('ir_phone_area', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.phoneArea', ['attribute' => $attribute]);
        });

        Validator::replacer('ir_postal_code', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.postalCode', ['attribute' => $attribute]);
        });

        Validator::replacer('ir_company_id', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.companyId', ['attribute' => $attribute]);
        });

        Validator::replacer('ir_sheba', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.shebaNumber', ['attribute' => $attribute]);
        });

        Validator::replacer('ir_bank_card', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.cardNumber', ['attribute' => $attribute]);
        });

        Validator::replacer('domain', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.domain', ['attribute' => $attribute]);
        });

        Validator::replacer('url_format', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.url', ['attribute' => $attribute]);
        });

        Validator::replacer('username_format', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.username', ['attribute' => $attribute]);
        });

        Validator::replacer('base64_format', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.base64', ['attribute' => $attribute]);
        });

        Validator::replacer('address_format', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.address', ['attribute' => $attribute]);
        });

        Validator::replacer('is_not_persian', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.isNotPersian', ['attribute' => $attribute]);
        });

        Validator::replacer('shamsi_date', function ($message, $attribute, $rule, $parameters) {
            return __('validationRules::messages.shamsiDate', ['attribute' => $attribute]);
        });

        Validator::replacer('shamsi_date_between', function ($message, $attribute, $rule, $parameters) {
            $startYear = $parameters[0] ?? 1300;
            $endYear = $parameters[1] ?? 1500;
            return __('validationRules::messages.shamsiDateBetween', [
                'attribute' => $attribute,
                'start_year' => $startYear,
                'end_year' => $endYear
            ]);
        });
    }
}
