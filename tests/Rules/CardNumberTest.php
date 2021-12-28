<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\CardNumber;
use Illuminate\Support\Facades\Validator;
use Iamfarhad\Validation\Tests\TestCase;

class CardNumberTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new CardNumber();
    }

    public function test_valid_persian_card_number(): void
    {
        $this->assertTrue($this->rule->passes('card_number', '0590995099116037'));
    }

    public function test_invalid_persian_card_number(): void
    {
        $this->assertFalse($this->rule->passes('card_number', '0590995099116038'));
    }

    public function test_valid_persian_card_number_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'card_number' => '0590995099116037',
            ],
            [
                'card_number' => [new CardNumber()],
            ]
        )->passes());
    }

    public function test_invalid_persian_card_number_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'card_number' => '0590995099116038',
            ],
            [
                'card_number' => [new CardNumber()],
            ]
        )->passes());
    }

    public function test_failed_persian_card_number_message(): void
    {
        $validator = Validator::make(
            ['card_number' => '0590995099116038'],
            ['card_number' => [new CardNumber()]]
        )->errors()->first();

        $this->assertSame('must be a valid payment card number.', $validator);
    }
}
