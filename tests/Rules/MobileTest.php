<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Mobile;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class MobileTest extends TestCase
{
    public function test_valid_mobile_numbers(): void
    {
        $validMobiles = [
            '09123456789',
            '09901234567',
            '09351234567',
            '09121234567',
        ];

        foreach ($validMobiles as $mobile) {
            $validator = Validator::make(
                ['mobile' => $mobile],
                ['mobile' => [new Mobile()]]
            );

            $this->assertTrue($validator->passes(), "Mobile {$mobile} should be valid");
        }
    }

    public function test_invalid_mobile_numbers(): void
    {
        $invalidMobiles = [
            '091234567890',  // Too long
            '0912345678',    // Too short
            '08123456789',   // Wrong prefix
            '9123456789',    // Missing leading zero
            '091234567ab',   // Contains letters
            '02123456789',   // Landline format
        ];

        foreach ($invalidMobiles as $mobile) {
            $validator = Validator::make(
                ['mobile' => $mobile],
                ['mobile' => [new Mobile()]]
            );

            $this->assertFalse($validator->passes(), "Mobile {$mobile} should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['mobile' => '08123456789'],
            ['mobile' => [new Mobile()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('mobile', $validator->errors()->toArray());
    }
}
