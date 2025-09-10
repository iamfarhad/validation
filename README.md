[![Latest Stable Version](https://poser.pugx.org/iamfarhad/validation/v/stable)](https://packagist.org/packages/iamfarhad/validation)
[![License](https://poser.pugx.org/iamfarhad/validation/license)](https://packagist.org/packages/iamfarhad/validation)
[![Total Downloads](https://poser.pugx.org/iamfarhad/validation/downloads)](https://packagist.org/packages/iamfarhad/validation)
[![Tests](https://github.com/iamfarhad/validation/workflows/run-tests/badge.svg)](https://github.com/iamfarhad/validation/actions)

# Laravel Persian Validation

A comprehensive Laravel validation package for Persian (Farsi) language and Iranian-specific data validation. This package provides a complete set of validation rules for Persian text, Iranian national codes, mobile numbers, bank account numbers (Sheba), postal codes, and more.

## ✨ Features

- **🔤 Persian Text Validation**: Persian alphabet and number validation
- **📱 Iranian Mobile Numbers**: Complete validation for all Iranian mobile operators
- **🏦 Banking**: Sheba (IBAN) validation for Iranian banks
- **🆔 National Code**: Iranian national identification code validation
- **📮 Postal Code**: Iranian postal code format validation
- **📞 Phone Numbers**: Landline and area code validation
- **💳 Payment Cards**: Credit/debit card number validation with Luhn algorithm
- **👤 Username**: Standard username format validation
- **🔐 Base64**: Base64 string format validation
- **🏠 Address**: Multi-language address validation

## 📋 Requirements

- **PHP**: 8.1, 8.2, 8.3, 8.4
- **Laravel**: 10.x, 11.x, 12.x
- **PHPUnit**: 10.x, 11.x, 12.x (for testing)

## 📦 Installation

Install the package via Composer:

```bash
composer require iamfarhad/validation
```

The package will automatically register itself with Laravel's service container.

## 🚀 Usage

All validation rules implement Laravel's modern `ValidationRule` interface and can be used directly in your validation arrays:

### Basic Usage

```php
use Illuminate\Support\Facades\Validator;
use Iamfarhad\Validation\Rules\NationalCode;

$validator = Validator::make($request->all(), [
    'national_code' => ['required', new NationalCode()],
]);
```

### In Form Requests

```php
use Iamfarhad\Validation\Rules\Mobile;
use Iamfarhad\Validation\Rules\NationalCode;

public function rules(): array
{
    return [
        'name' => ['required', 'string'],
        'national_code' => ['required', new NationalCode()],
        'mobile' => ['required', new Mobile()],
    ];
}
```

## 📚 Available Validation Rules

| Rule | Description | Example |
|------|-------------|---------|
| `NationalCode` | Iranian national identification code | `0112169228` |
| `Mobile` | Iranian mobile phone numbers | `09123456789` |
| `Sheba` | Iranian bank account numbers (IBAN) | `IR930150000001351800087201` |
| `PersianAlpha` | Persian alphabet characters only | `فارسی` |
| `PersianNumber` | Persian numeric characters | `۱۲۳۴۵۶۷۸۹۰` |
| `Phone` | Iranian landline phone numbers | `22345678` |
| `PhoneArea` | Phone numbers with area codes | `02122345678` |
| `PostalCode` | Iranian postal codes | `1234567890` |
| `CardNumber` | Payment card numbers (Luhn) | `4532015112830366` |
| `Address` | Multi-language addresses | `تهران، خیابان آزادی` |
| `Username` | Standard username format | `user_name123` |
| `Base64` | Base64 encoded strings | `SGVsbG8gV29ybGQ=` |
| `IsNotPersian` | Text without Persian characters | `Hello World` |

## 🔍 Detailed Examples

### Persian Text Validation

```php
use Iamfarhad\Validation\Rules\PersianAlpha;
use Iamfarhad\Validation\Rules\PersianNumber;

// Persian alphabet only
Validator::make(['name' => 'فارسی'], [
    'name' => [new PersianAlpha()]
]);

// Persian numbers only
Validator::make(['number' => '۱۲۳۴۵'], [
    'number' => [new PersianNumber()]
]);
```

### Iranian Mobile Numbers

```php
use Iamfarhad\Validation\Rules\Mobile;

// Supports all Iranian operators (Irancell, Rightel, Hamrah-e Avval, etc.)
Validator::make(['mobile' => '09123456789'], [
    'mobile' => [new Mobile()]
]);
```

### National Code Validation

```php
use Iamfarhad\Validation\Rules\NationalCode;

// Validates Iranian national identification codes
Validator::make(['national_code' => '0112169228'], [
    'national_code' => [new NationalCode()]
]);
```

### Banking (Sheba) Validation

```php
use Iamfarhad\Validation\Rules\Sheba;

// Iranian bank account numbers (IBAN format)
Validator::make(['account' => 'IR930150000001351800087201'], [
    'account' => [new Sheba()]
]);
```

### Phone Numbers

```php
use Iamfarhad\Validation\Rules\Phone;
use Iamfarhad\Validation\Rules\PhoneArea;

// Landline numbers
Validator::make(['phone' => '22345678'], [
    'phone' => [new Phone()]
]);

// With area code
Validator::make(['phone_area' => '02122345678'], [
    'phone_area' => [new PhoneArea()]
]);
```

### Payment Cards

```php
use Iamfarhad\Validation\Rules\CardNumber;

// Validates using Luhn algorithm
Validator::make(['card' => '4532015112830366'], [
    'card' => [new CardNumber()]
]);
```

### Multiple Rules

```php
use Iamfarhad\Validation\Rules\{Mobile, NationalCode, PersianAlpha};

$validator = Validator::make($request->all(), [
    'first_name' => ['required', new PersianAlpha()],
    'last_name' => ['required', new PersianAlpha()],
    'national_code' => ['required', new NationalCode()],
    'mobile' => ['required', new Mobile()],
]);

if ($validator->fails()) {
    return back()->withErrors($validator)->withInput();
}
```

## 🌐 Translations

Publish the language files to customize error messages:

```bash
php artisan vendor:publish --provider="Iamfarhad\Validation\ValidationRulesServiceProvider"
```

This will publish translation files to `lang/vendor/validationRules/` directory where you can customize the error messages for each validation rule.

### Available Languages

- **English** (`en/messages.php`)
- **Persian/Farsi** (`fa/messages.php`)

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
composer test

# Run tests with coverage
composer test-coverage

# Run static analysis
composer analyse

# Run code formatting
composer format

# Run all checks (format, analyse, test)
composer ci
```

## 🏗️ Development

### Requirements for Development

- PHP 8.1+
- Composer
- Laravel 10+

### Setup

```bash
git clone https://github.com/iamfarhad/validation.git
cd validation
composer install
composer test
```

### Code Quality

This package follows strict code quality standards:

- **PHPStan Level 8** static analysis
- **Laravel Pint** code formatting (Laravel preset)
- **PHPUnit 10+** for testing
- **GitHub Actions** for CI/CD

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request. For major changes, please open an issue first to discuss what you would like to change.

### Guidelines

1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. **Write** tests for your changes
4. **Ensure** all tests pass (`composer ci`)
5. **Commit** your changes (`git commit -m 'Add amazing feature'`)
6. **Push** to the branch (`git push origin feature/amazing-feature`)
7. **Open** a Pull Request

### Running Tests

```bash
# Install dependencies
composer install

# Run the full test suite
composer ci
```

## 📄 License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Farhad Zand**
- GitHub: [@iamfarhad](https://github.com/iamfarhad)
- Email: farhad.pd@gmail.com

## 🙏 Support

If you find this package helpful, please consider:

- ⭐ **Starring** the repository
- 🐛 **Reporting** issues
- 💡 **Suggesting** new features
- 🔀 **Contributing** code improvements
- 📢 **Sharing** with the community

---

Made with ❤️ for the Laravel and Persian developer community.