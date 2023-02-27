<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\IsNotPersian;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class IsNotPersianTest extends TestCase
{
    private \Iamfarhad\Validation\Rules\IsNotPersian $isNotPersian;

    protected function setUp(): void
    {
        parent::setUp();

        $this->isNotPersian = new IsNotPersian();
    }

    public function test_valid_is_not_persian(): void
    {
        $this->assertTrue($this->isNotPersian->passes('is_not_persian', 'hello world!'));
    }

    public function test_invalid_is_not_persian(): void
    {
        $this->assertFalse($this->isNotPersian->passes('is_not_persian', 'سلام دنیا'));
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
