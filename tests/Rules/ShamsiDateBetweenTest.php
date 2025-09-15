<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\ShamsiDateBetween;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class ShamsiDateBetweenTest extends TestCase
{
    public function test_valid_shamsi_dates_between(): void
    {
        $validDates = [
            '1380/01/01',      // Start year
            '1390/06/15',      // Middle year
            '1400/12/29',      // End year
        ];

        foreach ($validDates as $date) {
            $validator = Validator::make(
                ['date' => $date],
                ['date' => [new ShamsiDateBetween(1380, 1400)]]
            );

            $this->assertTrue($validator->passes(), "Shamsi date between '{$date}' should be valid");
        }
    }

    public function test_valid_shamsi_dates_between_with_persian_numbers(): void
    {
        $validDates = [
            '۱۳۸۰/۰۱/۰۱',      // Persian numbers
            '۱۳۹۰/۰۶/۱۵',      // Persian numbers
        ];

        foreach ($validDates as $date) {
            $validator = Validator::make(
                ['date' => $date],
                ['date' => [new ShamsiDateBetween(1380, 1400, '/', true)]]
            );

            $this->assertTrue($validator->passes(), "Shamsi date between with Persian numbers '{$date}' should be valid");
        }
    }

    public function test_valid_shamsi_dates_between_with_different_separators(): void
    {
        $validDates = [
            '1380-01-01',      // Dash separator
            '1390.06.15',      // Dot separator
            '1400|12|29',      // Pipe separator
        ];

        $separators = ['-', '.', '|'];

        foreach ($validDates as $index => $date) {
            $validator = Validator::make(
                ['date' => $date],
                ['date' => [new ShamsiDateBetween(1380, 1400, $separators[$index])]]
            );

            $this->assertTrue($validator->passes(), "Shamsi date between with separator '{$date}' should be valid");
        }
    }

    public function test_invalid_shamsi_dates_between(): void
    {
        $invalidDates = [
            '1379/12/29',      // Year before start
            '1401/01/01',      // Year after end
            '1300/01/01',      // Way before start
            '1500/01/01',      // Way after end
            '1380/13/01',      // Valid year but invalid month
            '1380/01/32',      // Valid year but invalid day
            'invalid-date',    // Completely invalid
        ];

        foreach ($invalidDates as $date) {
            $validator = Validator::make(
                ['date' => $date],
                ['date' => [new ShamsiDateBetween(1380, 1400)]]
            );

            $this->assertFalse($validator->passes(), "Shamsi date between '{$date}' should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['date' => '1379/01/01'],
            ['date' => [new ShamsiDateBetween(1380, 1400)]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('date', $validator->errors()->toArray());
    }

    public function test_edge_cases(): void
    {
        // Test exact boundary dates
        $edgeCases = [
            ['1380/01/01', true],  // Exact start
            ['1400/12/29', true],  // Exact end
            ['1379/12/30', false], // Just before start
            ['1401/01/01', false], // Just after end
        ];

        foreach ($edgeCases as [$date, $shouldPass]) {
            $validator = Validator::make(
                ['date' => $date],
                ['date' => [new ShamsiDateBetween(1380, 1400)]]
            );

            if ($shouldPass) {
                $this->assertTrue($validator->passes(), "Edge case date '{$date}' should be valid");
            } else {
                $this->assertFalse($validator->passes(), "Edge case date '{$date}' should be invalid");
            }
        }
    }
}
