<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Phone;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class PhoneTest extends TestCase
{
    public function test_valid_phone_numbers(): void
    {
        $validPhones = [
            '22345678',
            '33456789',
            '44567890',
            '55678901',
            '66789012',
            '77890123',
            '88901234',
            '99012345',
        ];

        foreach ($validPhones as $phone) {
            $validator = Validator::make(
                ['phone' => $phone],
                ['phone' => [new Phone]]
            );

            $this->assertTrue($validator->passes(), "Phone {$phone} should be valid");
        }
    }

    public function test_invalid_phone_numbers(): void
    {
        $invalidPhones = [
            '12345678',        // Starts with 1 (invalid)
            '02345678',        // Starts with 0 (invalid)
            '1234567',         // Too short
            '123456789',       // Too long
            '2234567a',        // Contains letters
            '2234-5678',       // Contains dash
            '2234 5678',       // Contains space
        ];

        foreach ($invalidPhones as $phone) {
            $validator = Validator::make(
                ['phone' => $phone],
                ['phone' => [new Phone]]
            );

            $this->assertFalse($validator->passes(), "Phone {$phone} should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['phone' => '12345678'],
            ['phone' => [new Phone]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('phone', $validator->errors()->toArray());
    }
}
