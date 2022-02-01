[![Latest Stable Version](https://poser.pugx.org/iamfarhad/validation/v/stable)](https://packagist.org/packages/iamfarhad/validation)
[![License](https://poser.pugx.org/iamfarhad/validation/license)](https://packagist.org/packages/iamfarhad/validation)
[![Total Downloads](https://poser.pugx.org/iamfarhad/validation/downloads)](https://packagist.org/packages/iamfarhad/validation)

# Laravel Persian Validation

Laravel Persian Validation provides validation for Persian alphabet, number and etc.

## Requirement

* Laravel 6.* | 8.x | 9.x
* PHP 7.3 | 7.4 | 8.0 | 8.1

## Install

Via Composer

``` bash
$ composer require iamfarhad/validation
```

The package will automatically register itself.

### Translations

If you wish to edit the package translations, you can run the following command to publish them into your `resources/lang` (or `/lang` in Laravel 9.x) folder

```bash
php artisan vendor:publish --provider="Iamfarhad\Validation\ValidationRulesServiceProvider"
```

## Testing
You can run the tests with:

```bash
composer test
```

## Usage

You can access to validation rules by passing the rules key according blew following table:

| Rules               | Descriptions                                                                                      |
|---------------------|---------------------------------------------------------------------------------------------------|
| new PersianAlpha()  | Persian alphabet                                                                                  |
| new PersianNumber() | Persian numbers                                                                                   |
| new Mobile()        | Iran mobile numbers                                                                               |
| new Sheba()         | Iran Sheba numbers                                                                                |
| new NationalCode()  | Iran melli code                                                                                   |
| new IsNotPersian()  | Doesn't accept Persian alphabet and numbers                                                       |
| new Mobile()        | Iran mobile numbers                                                                               |
| new Phone()         | Iran phone numbers                                                                                |
| new PhoneArea()     | Iran phone numbers with area code                                                                 |
| new CardNumber()    | Payment card numbers                                                                              |
| new Address()       | Accept Persian, English and ... alphabet, Persian and English numbers and some special characters |
| new PostalCode()    | Iran postal code                                                                                  |

### Persian Alphabet
Accept Persian language alphabet according to standard Persian, this is the way you can use this validation rule:

``` php
Validator::make(
    ['name' => 'فارسی'],
    ['name' => [new PersianAlpha()]
);
```

### Persian numbers
Validate Persian standard numbers (۰۱۲۳۴۵۶۷۸۹):

``` php
Validator::make(
    ['num' => '۰۱۲۳۴۵۶۷۸۹'],
    ['num' => [new PersianNumber()]
);
```

### Iran mobile phone
Validate Iran mobile phones (irancel, rightel, hamrah-e-aval, ...):

``` php
Validator::make(
    ['mob' => '09127777777'],
    ['mob' => [new Mobile()]
);
```

### Sheba number
Validate Iran bank sheba numbers:

``` php
Validator::make(
    ['sheba_number' => 'IR062960000000100324200001'],
    ['sheba_number' => [new Sheba()]
);
```

### Iran national code
Validate Iran national code (melli-code):

``` php
Validator::make(
    ['codeMelli' => '3240175800'],
    ['codeMelli' => [new NationalCode()]
);
```

### Payment card number
Validate Iran payment card numbers:

``` php
Validator::make(
    ['card' => '6274129005473742'],
    ['card' => [new CardNumber()]
);
```

### Iran postal code
Validate Iran postal code:

``` php
Validator::make(
    ['postal' => '16719735744'],
    ['postal' => [new PostalCode()]
);
```

```php
// in a `FormRequest`

public function rules()
{
    return [
        'NationalCode' => ['required', new NationalCode()],
    ];
}
```

## Team
This component is developed by the following person(s)

| [![Farhad Zand](https://avatars3.githubusercontent.com/u/1936147?v=3&s=130)](https://github.com/iamfarhad) 
--- |
| [Farhad Zand](https://github.com/iamfarhad)

## Support This Project

Please contribute in package completion. This is the best support.

## License

The Laravel persian validation Module is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
