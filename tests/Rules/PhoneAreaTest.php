<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\PhoneArea;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class PhoneAreaTest extends TestCase
{
    public function test_valid_phone_area_numbers(): void
    {
        $validPhones = [
            '02122345678',     // Tehran
            '03122345678',     // Isfahan
            '07122345678',     // Shiraz
            '01122345678',     // Gilan
            '08122345678',     // Kermanshah
        ];

        foreach ($validPhones as $phone) {
            $validator = Validator::make(
                ['phone_area' => $phone],
                ['phone_area' => [new PhoneArea]]
            );

            $this->assertTrue($validator->passes(), "Phone area {$phone} should be valid");
        }
    }

    public function test_invalid_phone_area_numbers(): void
    {
        $invalidPhones = [
            '2122345678',      // Missing leading zero
            '00122345678',     // Invalid area code (00)
            '02012345678',     // Invalid second digit in phone part (0)
            '02112345678',     // Invalid second digit in phone part (1)
            '021234567',       // Too short
            '0212345678901',   // Too long
            '021234567a',      // Contains letters
            '021-2345678',     // Contains dash
            '021 2345678',     // Contains space
        ];

        foreach ($invalidPhones as $phone) {
            $validator = Validator::make(
                ['phone_area' => $phone],
                ['phone_area' => [new PhoneArea]]
            );

            $this->assertFalse($validator->passes(), "Phone area {$phone} should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['phone_area' => '2122345678'],
            ['phone_area' => [new PhoneArea]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('phone_area', $validator->errors()->toArray());
    }
}
