<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class ShamsiDate implements ValidationRule
{
    private string $separator;
    private bool $convertPersianNumbers;

    public function __construct(string $separator = '/', bool $convertPersianNumbers = false)
    {
        $this->separator = $separator;
        $this->convertPersianNumbers = $convertPersianNumbers;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || empty($value)) {
            $fail(__('validationRules::messages.shamsiDate', ['attribute' => $attribute]));
            return;
        }

        if ($this->convertPersianNumbers) {
            $value = $this->convertPersianToEnglish($value);
        }

        $pattern = '#^(\d{4})' . preg_quote($this->separator, '#') . '(\d{1,2})' . preg_quote($this->separator, '#') . '(\d{1,2})$#';

        if (! preg_match($pattern, $value, $matches)) {
            $fail(__('validationRules::messages.shamsiDate', ['attribute' => $attribute]));
            return;
        }

        $year = (int) $matches[1];
        $month = (int) $matches[2];
        $day = (int) $matches[3];

        // Validate year range (1000-1600 Shamsi)
        if ($year < 1000 || $year > 1600) {
            $fail(__('validationRules::messages.shamsiDate', ['attribute' => $attribute]));
            return;
        }

        // Validate month (1-12)
        if ($month < 1 || $month > 12) {
            $fail(__('validationRules::messages.shamsiDate', ['attribute' => $attribute]));
            return;
        }

        // Validate day based on month
        $daysInMonth = $this->getDaysInShamsiMonth($year, $month);
        if ($day < 1 || $day > $daysInMonth) {
            $fail(__('validationRules::messages.shamsiDate', ['attribute' => $attribute]));
        }
    }

    private function convertPersianToEnglish(string $value): string
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($persian, $english, $value);
    }

    private function getDaysInShamsiMonth(int $year, int $month): int
    {
        // First 6 months have 31 days
        if ($month <= 6) {
            return 31;
        }

        // Next 5 months have 30 days
        if ($month <= 11) {
            return 30;
        }

        // Last month (Esfand) has 29 days, 30 in leap years
        return $this->isShamsiLeapYear($year) ? 30 : 29;
    }

    private function isShamsiLeapYear(int $year): bool
    {
        // Simplified Persian calendar leap year calculation
        // Based on 33-year cycles with known leap years
        $leapYears = [1395, 1399, 1403, 1407, 1411, 1415, 1419, 1423, 1427];
        return in_array($year, $leapYears);
    }
}
