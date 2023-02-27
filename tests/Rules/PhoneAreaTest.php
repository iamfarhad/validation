<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\PhoneArea;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class PhoneAreaTest extends TestCase
{
    private \Iamfarhad\Validation\Rules\PhoneArea $phoneArea;

    protected function setUp(): void
    {
        parent::setUp();

        $this->phoneArea = new PhoneArea();
    }

    public function test_valid_persian_phone_area_number(): void
    {
        $this->assertTrue($this->phoneArea->passes('phone', '08132214785'));
    }

    public function test_invalid_persian_phone_area_number(): void
    {
        $this->assertFalse($this->phoneArea->passes('phone', '081322147853'));
    }

    public function test_valid_persian_phone_area_number_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'phone' => '08132214785',
            ],
            [
                'phone' => [new PhoneArea()],
            ]
        )->passes());
    }

    public function test_invalid_persian_phone_area_number_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'phone' => '081322147856',
            ],
            [
                'phone' => [new PhoneArea()],
            ]
        )->passes());
    }

    public function test_failed_persian_phone_area_number_message(): void
    {
        $validator = Validator::make(
            ['phone' => '081322147852'],
            ['phone' => [new PhoneArea()]]
        )->errors()->first();

        $this->assertSame('must be a iran phone number with area code.', $validator);
    }
}
