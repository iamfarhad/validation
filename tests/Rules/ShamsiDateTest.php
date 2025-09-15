<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\ShamsiDate;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class ShamsiDateTest extends TestCase
{
    public function test_valid_shamsi_dates(): void
    {
        $validDates = [
            '1400/01/01',      // First day of year
            '1400/12/29',      // Last day of normal year
            '1395/12/30',      // Last day of leap year
            '1350/06/31',      // Last day of first 6 months
            '1350/07/30',      // Last day of next 5 months
            '1200/05/15',      // Middle date
        ];

        foreach ($validDates as $date) {
            $validator = Validator::make(
                ['date' => $date],
                ['date' => [new ShamsiDate()]]
            );

            $this->assertTrue($validator->passes(), "Shamsi date '{$date}' should be valid");
        }
    }

    public function test_valid_shamsi_dates_with_persian_numbers(): void
    {
        $validDates = [
            '۱۴۰۰/۰۱/۰۱',      // Persian numbers
            '۱۳۹۵/۱۲/۳۰',      // Persian numbers leap year
        ];

        foreach ($validDates as $date) {
            $validator = Validator::make(
                ['date' => $date],
                ['date' => [new ShamsiDate('/', true)]] // convertPersianNumbers = true
            );

            $this->assertTrue($validator->passes(), "Shamsi date with Persian numbers '{$date}' should be valid");
        }
    }

    public function test_valid_shamsi_dates_with_different_separators(): void
    {
        $validDates = [
            '1400-01-01',      // Dash separator
            '1400.01.01',      // Dot separator
            '1400|01|01',      // Pipe separator
        ];

        $separators = ['-', '.', '|'];

        foreach ($validDates as $index => $date) {
            $validator = Validator::make(
                ['date' => $date],
                ['date' => [new ShamsiDate($separators[$index])]]
            );

            $this->assertTrue($validator->passes(), "Shamsi date with separator '{$date}' should be valid");
        }
    }

    public function test_invalid_shamsi_dates(): void
    {
        $invalidDates = [
            '1400/13/01',      // Invalid month (13)
            '1400/00/01',      // Invalid month (0)
            '1400/01/32',      // Invalid day for first 6 months
            '1400/07/31',      // Invalid day for months 7-11
            '1400/12/31',      // Invalid day for month 12 (normal year)
            '999/01/01',       // Year too low
            '1601/01/01',      // Year too high
            '14/01/01',        // Invalid year format (should be 4 digits)
            '1400-01-01',      // Wrong separator (expecting /)
            'invalid-date',    // Completely invalid
        ];

        foreach ($invalidDates as $date) {
            $validator = Validator::make(
                ['date' => $date],
                ['date' => [new ShamsiDate()]]
            );

            $this->assertFalse($validator->passes(), "Shamsi date '{$date}' should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['date' => '1400/13/01'],
            ['date' => [new ShamsiDate()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('date', $validator->errors()->toArray());
    }
}
