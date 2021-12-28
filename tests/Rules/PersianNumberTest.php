<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Illuminate\Support\Facades\Validator;
use Iamfarhad\Validation\Rules\PersianNumber;
use Iamfarhad\Validation\Tests\TestCase;

class PersianNumberTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new PersianNumber();
    }

    public function test_valid_persian_number(): void
    {
        $this->assertTrue($this->rule->passes('class_number', '۲۱۳۴'));
    }

    public function test_invalid_persian_number(): void
    {
        $this->assertFalse($this->rule->passes('class_number', '2134'));
    }

    public function test_valid_persian_number_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'class_number' => '۲۱۳۴',
            ],
            [
                'class_number' => [new PersianNumber()],
            ]
        )->passes());
    }

    public function test_invalid_persian_number_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'class_number' => '2134',
            ],
            [
                'class_number' => [new PersianNumber()],
            ]
        )->passes());
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function test_failed_persian_number_message(): void
    {
        $validator = Validator::make(
            ['class_number' => '2134'],
            ['class_number' => [new PersianNumber()]]
        )->errors()->first();

        $this->assertSame('must be a persian number.', $validator);
    }
}
