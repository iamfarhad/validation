<?php

namespace Iamfarhad\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class ShamsiDateBetween implements ValidationRule
{
    private int $startYear;
    private int $endYear;
    private string $separator;
    private bool $convertPersianNumbers;

    public function __construct(int $startYear, int $endYear, string $separator = '/', bool $convertPersianNumbers = false)
    {
        $this->startYear = $startYear;
        $this->endYear = $endYear;
        $this->separator = $separator;
        $this->convertPersianNumbers = $convertPersianNumbers;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail(__('validationRules::messages.shamsiDateBetween', ['attribute' => $attribute, 'start_year' => $this->startYear, 'end_year' => $this->endYear]));
            return;
        }

        // First validate it's a valid Shamsi date
        $shamsiDateRule = new ShamsiDate($this->separator, $this->convertPersianNumbers);
        $shamsiDateRule->validate($attribute, $value, $fail);

        // If basic validation failed, don't continue
        if ($this->hasValidationFailed($value)) {
            return;
        }

        if ($this->convertPersianNumbers) {
            $value = $this->convertPersianToEnglish($value);
        }

        $pattern = '#^(\d{4})' . preg_quote($this->separator, '#') . '(\d{1,2})' . preg_quote($this->separator, '#') . '(\d{1,2})$#';

        if (preg_match($pattern, $value, $matches)) {
            $year = (int) $matches[1];

            if ($year < $this->startYear || $year > $this->endYear) {
                $fail(__('validationRules::messages.shamsiDateBetween', ['attribute' => $attribute, 'start_year' => $this->startYear, 'end_year' => $this->endYear]));
            }
        }
    }

    private function convertPersianToEnglish(string $value): string
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($persian, $english, $value);
    }

    private function hasValidationFailed(string $value): bool
    {
        // Simple check to see if the date format is valid
        if ($this->convertPersianNumbers) {
            $value = $this->convertPersianToEnglish($value);
        }

        $pattern = '#^(\d{4})' . preg_quote($this->separator, '#') . '(\d{1,2})' . preg_quote($this->separator, '#') . '(\d{1,2})$#';

        return ! preg_match($pattern, $value);
    }
}
