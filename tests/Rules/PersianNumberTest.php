<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\PersianNumber;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class PersianNumberTest extends TestCase
{
    public function test_valid_persian_numbers(): void
    {
        $validNumbers = [
            '۱۲۳۴۵۶۷۸۹۰',
            '۱۲۳',
            '۰',
            '۹۸۷۶۵۴۳۲۱',
        ];

        foreach ($validNumbers as $number) {
            $validator = Validator::make(
                ['number' => $number],
                ['number' => [new PersianNumber()]]
            );

            $this->assertTrue($validator->passes(), "Persian number '{$number}' should be valid");
        }
    }

    public function test_invalid_persian_numbers(): void
    {
        $invalidNumbers = [
            '1234567890',      // English numbers
            '۱۲۳abc',         // Mixed Persian numbers and letters
            'abc',             // Only letters
            '۱۲۳ ۴۵۶',        // Persian numbers with space
            '۱۲۳-۴۵۶',        // Persian numbers with dash
        ];

        foreach ($invalidNumbers as $number) {
            $validator = Validator::make(
                ['number' => $number],
                ['number' => [new PersianNumber()]]
            );

            $this->assertFalse($validator->passes(), "Number '{$number}' should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['number' => '1234'],
            ['number' => [new PersianNumber()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('number', $validator->errors()->toArray());
    }
}
