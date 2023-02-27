<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Phone;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class PhoneTest extends TestCase
{
    private \Iamfarhad\Validation\Rules\Phone $phone;

    protected function setUp(): void
    {
        parent::setUp();

        $this->phone = new Phone();
    }

    public function test_valid_persian_phone_number(): void
    {
        $this->assertTrue($this->phone->passes('phone', '32214785'));
    }

    public function test_invalid_persian_phone_number(): void
    {
        $this->assertFalse($this->phone->passes('phone', '322147853'));
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
