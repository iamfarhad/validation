<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Phone;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class PhoneTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new Phone();
    }

    public function test_valid_persian_phone_number(): void
    {
        $this->assertTrue($this->rule->passes('phone', '32214785'));
    }

    public function test_invalid_persian_phone_number(): void
    {
        $this->assertFalse($this->rule->passes('phone', '322147853'));
    }

    public function test_valid_persian_phone_number_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'phone' => '32214785',
            ],
            [
                'phone' => [new Phone()],
            ]
        )->passes());
    }

    public function test_invalid_persian_phone_number_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'phone' => '322147856',
            ],
            [
                'phone' => [new Phone()],
            ]
        )->passes());
    }

    public function test_failed_persian_phone_number_message(): void
    {
        $validator = Validator::make(
            ['phone' => '322147852'],
            ['phone' => [new Phone()]]
        )->errors()->first();

        $this->assertSame('must be a iran phone number.', $validator);
    }
}
