<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\PersianAlpha;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class PersianAlphaTest extends TestCase
{
    private \Iamfarhad\Validation\Rules\PersianAlpha $persianAlpha;

    protected function setUp(): void
    {
        parent::setUp();

        $this->persianAlpha = new PersianAlpha();
    }

    public function test_valid_persian_alpha(): void
    {
        $this->assertTrue($this->persianAlpha->passes('persian_alpha', 'سلام دینا'));
    }

    public function test_invalid_persian_alpha(): void
    {
        $this->assertFalse($this->persianAlpha->passes('persian_alpha', 'hello world'));
    }

    public function test_valid_persian_alpha_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'persian_alpha' => 'سلام دنیا',
            ],
            [
                'persian_alpha' => [new PersianAlpha()],
            ]
        )->passes());
    }

    public function test_invalid_persian_alpha_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'persian_alpha' => 'hello world سلام دنیا',
            ],
            [
                'persian_alpha' => [new PersianAlpha()],
            ]
        )->passes());
    }

    public function test_failed_persian_alpha_message(): void
    {
        $validator = Validator::make(
            ['persian_alpha' => 'hello world سلام دنیا'],
            ['persian_alpha' => [new PersianAlpha()]]
        )->errors()->first();

        $this->assertSame('must be a persian alphabet.', $validator);
    }
}
