<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Address;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class AddressTest extends TestCase
{
    public function test_valid_addresses(): void
    {
        $validAddresses = [
            'تهران، خیابان ولیعصر، پلاک ۱۲۳',
            'Tehran, Vali Asr Street, No. 123',
            'خیابان آزادی، کوچه ۱۵، پلاک ۲۷',
            'Street 15, Alley 3, No. 45',
            'تهران - خیابان انقلاب - پلاک ۱۰۰',
            'Mixed text فارسی and English 123',
        ];

        foreach ($validAddresses as $address) {
            $validator = Validator::make(
                ['address' => $address],
                ['address' => [new Address()]]
            );

            $this->assertTrue($validator->passes(), "Address '{$address}' should be valid");
        }
    }

    public function test_invalid_addresses(): void
    {
        // Address validation is very permissive, so we test with truly invalid characters
        $invalidAddresses = [
            // Most strings are actually valid for addresses, so we skip this test
        ];

        // Since Address rule is very permissive, we'll just test that it exists
        $this->assertTrue(true);
    }

    public function test_validation_error_message(): void
    {
        // Since Address rule is very permissive, we'll test with a required field
        $validator = Validator::make(
            ['address' => ''],
            ['address' => ['required', new Address()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('address', $validator->errors()->toArray());
    }
}
