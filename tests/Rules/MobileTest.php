<?php
namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Mobile;
use Illuminate\Support\Facades\Validator;
use Iamfarhad\Validation\Tests\TestCase;

class MobileTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new Mobile();
    }

    public function test_valid_persian_mobile_number(): void
    {
        $this->assertTrue($this->rule->passes('mobile', '09127777777'));
    }

    public function test_invalid_persian_mobile_number(): void
    {
        $this->assertFalse($this->rule->passes('mobile', '091277777777'));
    }

    public function test_valid_persian_mobile_number_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'mobile' => '09127777777',
            ],
            [
                'mobile' => [new Mobile()],
            ]
        )->passes());
    }

    public function test_invalid_persian_mobile_number_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'mobile' => '091277777777',
            ],
            [
                'mobile' => [new Mobile()],
            ]
        )->passes());
    }

    public function test_failed_persian_mobile_number_message(): void
    {
        $validator = Validator::make(
            ['mobile' => '091277777777'],
            ['mobile' => [new Mobile()]]
        )->errors()->first();

        $this->assertSame('must be a iran mobile number.', $validator);
    }
}
