<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\PostalCode;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class PostalCodeTest extends TestCase
{
    private \Iamfarhad\Validation\Rules\PostalCode $postalCode;

    protected function setUp(): void
    {
        parent::setUp();

        $this->postalCode = new PostalCode();
    }

    public function test_valid_persian_postal_code(): void
    {
        $this->assertTrue($this->postalCode->passes('postal_code', '6385141552'));
    }

    public function test_invalid_persian_postal_code(): void
    {
        $this->assertFalse($this->postalCode->passes('postal_code', '63851-4122552'));
    }

    public function test_valid_persian_postal_code_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'postal_code' => '6385141552',
            ],
            [
                'postal_code' => [new PostalCode()],
            ]
        )->passes());
    }

    public function test_invalid_persian_postal_code_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'postal_code' => '638514155298',
            ],
            [
                'postal_code' => [new PostalCode()],
            ]
        )->passes());
    }

    public function test_failed_persian_postal_code_message(): void
    {
        $validator = Validator::make(
            ['postal_code' => '638514-15522'],
            ['postal_code' => [new PostalCode()]]
        )->errors()->first();

        $this->assertSame('must be a iran postal code.', $validator);
    }
}
