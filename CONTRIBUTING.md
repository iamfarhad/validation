# Contributing to Laravel Persian Validation

First off, thank you for considering contributing to Laravel Persian Validation! 🎉

## 🌟 How to Contribute

We welcome contributions from the Laravel and Persian developer community! There are many ways to contribute:

### 🐛 Bug Reports
- Found a bug? Please report it using our [bug report template](.github/ISSUE_TEMPLATE/bug_report.md)
- Make sure to include a clear description and code example
- Check existing issues first to avoid duplicates

### ✨ New Features
- Have an idea? Open a [feature request](.github/ISSUE_TEMPLATE/feature_request.md)
- Discuss the feature first before implementing
- Consider backward compatibility

### 📚 Documentation
- Improve README examples
- Add missing documentation
- Fix typos and grammar
- Translate documentation to other languages

### 🧪 Tests
- Add more test cases
- Improve test coverage
- Add edge case testing

## 🚀 Development Setup

### Prerequisites
- PHP 8.1+
- Composer
- Git

### Setup Steps

1. **Fork the repository**
   ```bash
   # Fork on GitHub, then clone your fork
   git clone https://github.com/YOUR_USERNAME/validation.git
   cd validation
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Create a branch**
   ```bash
   git checkout -b feature/your-feature-name
   # or
   git checkout -b fix/your-bug-fix
   ```

4. **Make your changes**
   - Write your code
   - Add/update tests
   - Update documentation if needed

5. **Test your changes**
   ```bash
   # Run all tests
   composer test
   
   # Run static analysis
   composer analyse
   
   # Run code formatting
   composer format
   
   # Run all checks
   composer ci
   ```

6. **Commit your changes**
   ```bash
   git add .
   git commit -m "Add: your descriptive commit message"
   ```

7. **Push and create PR**
   ```bash
   git push origin feature/your-feature-name
   # Then create a Pull Request on GitHub
   ```

## 📋 Code Standards

### Coding Style
- Follow **PSR-12** coding standard
- Use **Laravel Pint** for automatic formatting: `composer format`
- Use meaningful variable and method names
- Add proper PHPDoc comments for public methods

### Static Analysis
- Code must pass **PHPStan Level 8**
- Run: `composer analyse`
- Fix any issues before submitting

### Testing
- **100% test coverage** required for new features
- Write unit tests for all validation rules
- Test both valid and invalid inputs
- Include edge cases

### Example Test Structure
```php
final class YourRuleTest extends TestCase
{
    public function test_valid_inputs(): void
    {
        $validInputs = ['valid1', 'valid2'];
        
        foreach ($validInputs as $input) {
            $validator = Validator::make(
                ['field' => $input],
                ['field' => [new YourRule()]]
            );
            
            $this->assertTrue($validator->passes());
        }
    }
    
    public function test_invalid_inputs(): void
    {
        // Similar structure for invalid inputs
    }
}
```

## 🎯 Creating New Validation Rules

### ValidationRule Object
```php
<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class YourRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail(__('validationRules::messages.yourRule', ['attribute' => $attribute]));
            return;
        }

        if (! $this->isValid($value)) {
            $fail(__('validationRules::messages.yourRule', ['attribute' => $attribute]));
        }
    }

    private function isValid(string $value): bool
    {
        // Your validation logic here
        return true;
    }
}
```

### Register String Rule
Add to `ValidationServiceProvider.php`:

```php
// In registerValidationRules() method
Validator::extend('your_rule', $validateRule(new YourRule()));

// In the replacer section
Validator::replacer('your_rule', function ($message, $attribute, $rule, $parameters) {
    return __('validationRules::messages.yourRule', ['attribute' => $attribute]);
});
```

### Add Translation
Add to both `resources/lang/en/messages.php` and `resources/lang/fa/messages.php`:

```php
'yourRule' => 'must be a valid format.',
```

## 🌍 Iranian/Persian Context

When adding validation for Iranian data formats:

1. **Research Standards**: Check official Iranian standards and regulations
2. **Real-world Examples**: Provide examples of valid/invalid data
3. **Cultural Context**: Consider regional variations
4. **Documentation**: Explain the purpose and use cases

### Common Iranian Data Types
- National IDs (کد ملی)
- Mobile numbers (شماره موبایل)
- Landline phones (تلفن ثابت)
- Postal codes (کد پستی)
- Bank account numbers (شماره حساب)
- Company IDs (شناسه شرکت)
- Shamsi/Jalali dates (تاریخ شمسی)

## 📝 Commit Messages

Use conventional commits:

- `feat: add new validation rule`
- `fix: resolve issue with national code validation`
- `docs: update README examples`
- `test: add edge cases for mobile validation`
- `refactor: improve performance of date validation`

## 🔍 Pull Request Process

1. **Fill out the PR template** completely
2. **Link related issues** using "Fixes #123"
3. **Add appropriate labels**
4. **Request review** from maintainers
5. **Respond to feedback** promptly
6. **Update documentation** if needed

## ❓ Questions?

- Check existing [issues](https://github.com/iamfarhad/validation/issues)
- Create a [question issue](.github/ISSUE_TEMPLATE/question.md)
- Contact [@iamfarhad](https://github.com/iamfarhad)

## 🏆 Recognition

Contributors will be:
- Added to the contributors list
- Mentioned in release notes
- Credited in package documentation

## 📜 Code of Conduct

This project follows a [Code of Conduct](CODE_OF_CONDUCT.md). Please read it before contributing.

---

Thank you for making Laravel Persian Validation better! 🚀
