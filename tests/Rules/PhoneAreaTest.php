<?php
namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\PhoneArea;
use Illuminate\Support\Facades\Validator;
use Iamfarhad\Validation\Tests\TestCase;

class PhoneAreaTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new PhoneArea();
    }

    public function test_valid_persian_phone_area_number(): void
    {
        $this->assertTrue($this->rule->passes('phone', '08132214785'));
    }

    public function test_invalid_persian_phone_area_number(): void
    {
        $this->assertFalse($this->rule->passes('phone', '081322147853'));
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
