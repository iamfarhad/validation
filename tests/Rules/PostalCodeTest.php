<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\PostalCode;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class PostalCodeTest extends TestCase
{
    public function test_valid_postal_codes(): void
    {
        $validCodes = [
            '1234567890',
            '0123456789',
            '9876543210',
        ];

        foreach ($validCodes as $code) {
            $validator = Validator::make(
                ['postal_code' => $code],
                ['postal_code' => [new PostalCode]]
            );

            $this->assertTrue($validator->passes(), "Postal code {$code} should be valid");
        }
    }

    public function test_invalid_postal_codes(): void
    {
        $invalidCodes = [
            '123456789',       // Too short (9 digits)
            '12345678901',     // Too long (11 digits)
            '123456789a',      // Contains letters
            '1234-56789',      // Contains dash
            '1234 56789',      // Contains space
        ];

        foreach ($invalidCodes as $code) {
            $validator = Validator::make(
                ['postal_code' => $code],
                ['postal_code' => [new PostalCode]]
            );

            $this->assertFalse($validator->passes(), "Postal code {$code} should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['postal_code' => '123456789'],
            ['postal_code' => [new PostalCode]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('postal_code', $validator->errors()->toArray());
    }
}
