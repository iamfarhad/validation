[![Build Status](https://travis-ci.com/iamfarhad/validation.svg?branch=master)](https://travis-ci.com/iamfarhad/validation)
[![Build Status](https://scrutinizer-ci.com/g/iamfarhad/validation/badges/build.png?b=master)](https://scrutinizer-ci.com/g/iamfarhad/validation/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/iamfarhad/validation/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/iamfarhad/validation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/iamfarhad/validation/?branch=master)


# Laravel Persian Validation

Laravel Persian Validation provides validation for Persian alphabet, number and etc.

## Requirement

* Laravel 5.8.*
* PHP 7.1 >=

## License

Laravel Persian Validation is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

## Install

Via Composer

``` bash
$ composer require iamfarhad/validation
```

## Config

Add the following provider to providers part of config/app.php
``` php
Iamfarhad\Validation\ValidationServiceProvider::class
```

## vendor:publish
You can run vendor:publish command to have custom lang file of package on this path ( resources/lang/validation )

## Usage

You can access to validation rules by passing the rules key according blew following table:

| Rules | Descriptions |
| --- | --- |
| persian_alphabet | Persian alphabet |
| persian_number | Persian numbers |
| persian_alphabet_number | Persian alphabet and numbers |
| iran_mobile | Iran mobile numbers |
| sheba_number | Iran Sheba numbers |
| melli_code | Iran melli code |
| is_not_persian | Doesn't accept Persian alphabet and numbers |
| iran_phone | Iran phone numbers |
| iran_phone_area | Iran phone numbers with area code |
| card_number | Payment card numbers |
| iran_address | Accept Persian, English and ... alphabet, Persian and English numbers and some special characters|
| iran_postal_code | Iran postal code |

### Persian Alphabet
Accept Persian language alphabet according to standard Persian, this is the way you can use this validation rule:

```
$request = [ 'فارسی' ];

$rules = [ 'persian_alphabet' ];

Validator::make( $request, $rules );
```

### Persian numbers
Validate Persian standard numbers (۰۱۲۳۴۵۶۷۸۹):

```
$request = [ '۰۱۲۳۴۵۶۷۸۹' ];

$rules = [ 'persian_number' ];

Validator::make( $request, $rules );
```

### Persian Alphabet Number
Validate Persian alpha num:

```
$request = [ 'فارسی۱۲۳۴۵۶۷۸۹' ];

$rules = [ 'persian_alphabet_number' ];

Validator::make( $request, $rules );
```

### Iran mobile phone
Validate Iran mobile phones (irancel, rightel, hamrah-e-aval, ...):

```
$request = [ '09381234567' ];

$rules = [ 'iran_mobile' ];

Validator::make( $request, $rules );
```

### Sheba number
Validate Iran bank sheba numbers:

```
$request = [ 'IR062960000000100324200001' ];

$rules = [ 'sheba_number' ];

Validator::make( $request, $rules );
```

### Iran national code
Validate Iran national code (melli-code):

```
$request = [ '3240175800' ];

$rules = [ 'melli_code' ];

Validator::make( $request, $rules );
```

### Payment card number
Validate Iran payment card numbers:

```
$request = [ '6274129005473742' ];

$rules = [ 'card_number' ];

Validator::make( $request, $rules );
```

### Iran postal code
Validate Iran postal code:

```
$request = [ '167197-35744' ];

$rules = [ 'iran_postal_code' ];

Validator::make( $request, $rules );


$request = [ '16719735744' ];

$rules = [ 'iran_postal_code' ];

Validator::make( $request, $rules );

```

