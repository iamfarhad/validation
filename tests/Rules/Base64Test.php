<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Base64;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class Base64Test extends TestCase
{
    public function test_valid_base64_strings(): void
    {
        $validBase64 = [
            'SGVsbG8gV29ybGQ=',      // "Hello World"
            'VGVzdCBzdHJpbmc=',      // "Test string"
            'MTIzNDU2Nzg5MA==',      // "1234567890"
            'YWJjZGVmZ2hpams=',      // "abcdefghijk"
        ];

        foreach ($validBase64 as $base64) {
            $validator = Validator::make(
                ['data' => $base64],
                ['data' => [new Base64()]]
            );

            $this->assertTrue($validator->passes(), "Base64 string {$base64} should be valid");
        }
    }

    public function test_invalid_base64_strings(): void
    {
        $invalidBase64 = [
            'Hello World',           // Plain text
            'SGVsbG8gV29ybGQ',       // Missing padding
            'SGVsbG8gV29ybGQ===',    // Too much padding
            'SGVsbG8@V29ybGQ=',      // Invalid character (@)
            'SGVsbG8 V29ybGQ=',      // Contains space
        ];

        foreach ($invalidBase64 as $base64) {
            $validator = Validator::make(
                ['data' => $base64],
                ['data' => [new Base64()]]
            );

            $this->assertFalse($validator->passes(), "String {$base64} should be invalid base64");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['data' => 'Hello World'],
            ['data' => [new Base64()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('data', $validator->errors()->toArray());
    }
}
