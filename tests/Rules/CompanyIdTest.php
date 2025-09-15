<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\CompanyId;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class CompanyIdTest extends TestCase
{
    public function test_valid_company_ids(): void
    {
        $validIds = [
            '14007650912',  // Valid Iranian company ID
            // Note: Using a test ID that passes the algorithm
        ];

        foreach ($validIds as $id) {
            $validator = Validator::make(
                ['company_id' => $id],
                ['company_id' => [new CompanyId()]]
            );

            $this->assertTrue($validator->passes(), "Company ID {$id} should be valid");
        }
    }

    public function test_invalid_company_ids(): void
    {
        $invalidIds = [
            '1400765091',      // Too short (10 digits)
            '140076509123',    // Too long (12 digits)
            '1400765091a',     // Contains letters
            '1400-765091',     // Contains dash
            '1400 765091',     // Contains space
            '00000000000',     // All zeros
            '11111111111',     // All same digits
        ];

        foreach ($invalidIds as $id) {
            $validator = Validator::make(
                ['company_id' => $id],
                ['company_id' => [new CompanyId()]]
            );

            $this->assertFalse($validator->passes(), "Company ID {$id} should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['company_id' => '00000000000'],
            ['company_id' => [new CompanyId()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('company_id', $validator->errors()->toArray());
    }
}
