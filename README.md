[![Latest Stable Version](https://poser.pugx.org/iamfarhad/validation/v/stable)](https://packagist.org/packages/iamfarhad/validation)
[![License](https://poser.pugx.org/iamfarhad/validation/license)](https://packagist.org/packages/iamfarhad/validation)
[![Total Downloads](https://poser.pugx.org/iamfarhad/validation/downloads)](https://packagist.org/packages/iamfarhad/validation)

# Laravel Persian Validation

The Laravel Persian Validation package offers comprehensive validation for the Persian language, including validation for Persian alphabets, numbers, and other Persian-specific elements. This package allows developers to ensure that their Persian language input data meets the necessary validation criteria, enhancing the reliability and accuracy of their applications. With Laravel Persian Validation, developers can easily incorporate Persian language validation into their Laravel projects, providing a more inclusive and user-friendly experience for Persian-speaking users.




## Requirement

* Laravel 10.x | 11.x | 12.x
* PHP 8.1 | 8.2 | 8.3 | 8.4

## Install

Via Composer

``` bash
$ composer require iamfarhad/validation
```

This package is designed to automatically register itself without requiring any additional configuration.


### Translations

If you would like to customize the translations for the Laravel Persian Validation package, you can use the following command to publish them into your project's resources/lang directory:

```bash
php artisan vendor:publish --provider="Iamfarhad\Validation\ValidationRulesServiceProvider" --tag="translations"

```
If you are using Laravel 9.x or later, the translations will be published to the /lang directory instead. Once the translations are published, you can modify them as needed to suit your project's requirements.


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
| new Username()      | Username format                                                                                   |
| new Base64()        | Base64 format                                                                                     |

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

| [![Farhad Zand](https://avatars3.githubusercontent.com/u/1936147?v=3&s=130)](https://github.com/iamfarhad) |
|------------------------------------------------------------------------------------------------------------|
| [Farhad Zand](https://github.com/iamfarhad)                                                                |

## Support This Project

Great! It's always helpful to have more contributors to a package. Here are a few ways you can contribute to the package completion:

* Report Issues: If you find any bugs or issues with the package, you can report them on the package's GitHub repository. Be sure to provide detailed steps to reproduce the issue and any relevant code snippets.
* Submit Pull Requests: If you have a fix for a bug or an improvement to the package, you can submit a pull request on the package's GitHub repository. Be sure to follow the guidelines for contributing and to test your changes thoroughly.
* Improve Documentation: If you find any gaps in the package's documentation, you can contribute by improving the existing documentation or adding new documentation. You can do this by submitting a pull request on the package's GitHub repository.
* Spread the Word: You can help the package by spreading the word about it on social media, developer forums, and other channels. This can help attract more contributors and users to the package.

Remember that contributing to open-source projects like this package is a collaborative effort, and every little bit helps. Thank you for considering contributing!
## License

The Laravel persian validation Module is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
