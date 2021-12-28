<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\IsNotPersian;
use Illuminate\Support\Facades\Validator;
use Iamfarhad\Validation\Tests\TestCase;

class IsNotPersianTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new IsNotPersian();
    }

    public function test_valid_is_not_persian(): void
    {
        $this->assertTrue($this->rule->passes('is_not_persian', 'hello world!'));
    }

    public function test_invalid_is_not_persian(): void
    {
        $this->assertFalse($this->rule->passes('is_not_persian', 'سلام دنیا'));
    }

    public function test_valid_is_not_persian_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'is_not_persian' => 'hello world!',
            ],
            [
                'is_not_persian' => [new IsNotPersian()],
            ]
        )->passes());
    }

    public function test_invalid_is_not_persian_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'is_not_persian' => 'سلام دنیا',
            ],
            [
                'is_not_persian' => [new IsNotPersian()],
            ]
        )->passes());
    }

    public function test_failed_is_not_persian_message(): void
    {
        $validator = Validator::make(
            ['is_not_persian' => 'سلام دنیا'],
            ['is_not_persian' => [new IsNotPersian()]]
        )->errors()->first();

        $this->assertSame('could not be contain persian alpahbet or number.', $validator);
    }
}
