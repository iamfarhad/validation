<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\NationalCode;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class NationalCodeTest extends TestCase
{
    public function test_valid_national_codes(): void
    {
        $validCodes = [
            '0112169228',
            // Only use codes that actually pass the Iranian national code algorithm
        ];

        foreach ($validCodes as $code) {
            $validator = Validator::make(
                ['national_code' => $code],
                ['national_code' => [new NationalCode]]
            );

            $this->assertTrue($validator->passes(), "National code {$code} should be valid");
        }
    }

    public function test_invalid_national_codes(): void
    {
        $invalidCodes = [
            '0112169229',  // Invalid checksum
            '1111111111',  // All same digits
            '0000000000',  // All zeros
            '12345',       // Too short
            '12345678901', // Too long
            'abc1234567',  // Contains letters
        ];

        foreach ($invalidCodes as $code) {
            $validator = Validator::make(
                ['national_code' => $code],
                ['national_code' => [new NationalCode]]
            );

            $this->assertFalse($validator->passes(), "National code {$code} should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['national_code' => '0112169229'],
            ['national_code' => [new NationalCode]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('national_code', $validator->errors()->toArray());
    }
}
