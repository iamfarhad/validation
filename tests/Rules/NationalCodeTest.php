<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\NationalCode;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class NationalCodeTest extends TestCase
{
    private \Iamfarhad\Validation\Rules\NationalCode $nationalCode;

    protected function setUp(): void
    {
        parent::setUp();

        $this->nationalCode = new NationalCode();
    }

    public function test_valid_persian_national_code(): void
    {
        $this->assertTrue($this->nationalCode->passes('national_code', '0112169228'));
    }

    public function test_invalid_persian_national_code(): void
    {
        $this->assertFalse($this->nationalCode->passes('national_code', '0112169229'));
    }

    public function test_valid_persian_national_code_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'national_code' => '0112169228',
            ],
            [
                'national_code' => [new NationalCode()],
            ]
        )->passes());
    }

    public function test_invalid_persian_national_code_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'national_code' => '0112169229',
            ],
            [
                'national_code' => [new NationalCode()],
            ]
        )->passes());
    }

    public function test_failed_persian_national_code_message(): void
    {
        $validator = Validator::make(
            ['national_code' => '0112169229'],
            ['national_code' => [new NationalCode()]]
        )->errors()->first();

        $this->assertSame('must be a iran melli code.', $validator);
    }
}
