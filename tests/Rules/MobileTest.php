<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Mobile;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class MobileTest extends TestCase
{
    private \Iamfarhad\Validation\Rules\Mobile $mobile;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mobile = new Mobile();
    }

    public function test_valid_persian_mobile_number(): void
    {
        $this->assertTrue($this->mobile->passes('mobile', '09127777777'));
    }

    public function test_invalid_persian_mobile_number(): void
    {
        $this->assertFalse($this->mobile->passes('mobile', '091277777777'));
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
