<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Sheba;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class ShebaTest extends TestCase
{
    public function test_valid_sheba_numbers(): void
    {
        $validShebas = [
            'IR930150000001351800087201',
            // Only use actual valid IBAN numbers
        ];

        foreach ($validShebas as $sheba) {
            $validator = Validator::make(
                ['sheba' => $sheba],
                ['sheba' => [new Sheba()]]
            );

            $this->assertTrue($validator->passes(), "Sheba {$sheba} should be valid");
        }
    }

    public function test_invalid_sheba_numbers(): void
    {
        $invalidShebas = [
            'IR930150000001351800087202',  // Invalid checksum
            'IR93015000000135180008720',   // Too short
            'IR9301500000013518000872011', // Too long
            '930150000001351800087201',    // Missing IR prefix
            'US930150000001351800087201',  // Wrong country code
            'IR93015000000135180008720a',  // Contains letters in number part
            'IR12',                       // Too short
        ];

        foreach ($invalidShebas as $sheba) {
            $validator = Validator::make(
                ['sheba' => $sheba],
                ['sheba' => [new Sheba()]]
            );

            $this->assertFalse($validator->passes(), "Sheba {$sheba} should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['sheba' => 'IR930150000001351800087202'],
            ['sheba' => [new Sheba()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('sheba', $validator->errors()->toArray());
    }
}
