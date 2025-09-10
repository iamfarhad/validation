<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\CardNumber;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class CardNumberTest extends TestCase
{
    public function test_valid_card_numbers(): void
    {
        $validCards = [
            '4532015112830366',  // Valid Visa card (Luhn algorithm)
            '5555555555554444',  // Valid MasterCard
            '4000000000000002',  // Valid test card
        ];

        foreach ($validCards as $card) {
            $validator = Validator::make(
                ['card_number' => $card],
                ['card_number' => [new CardNumber]]
            );

            $this->assertTrue($validator->passes(), "Card number {$card} should be valid");
        }
    }

    public function test_invalid_card_numbers(): void
    {
        $invalidCards = [
            '4532015112830367',  // Invalid checksum
            '453201511283036',   // Too short (15 digits)
            '45320151128303671', // Too long (17 digits)
            '453201511283036a',  // Contains letters
            '4532-0151-1283-0366', // Contains dashes
            '4532 0151 1283 0366', // Contains spaces
        ];

        foreach ($invalidCards as $card) {
            $validator = Validator::make(
                ['card_number' => $card],
                ['card_number' => [new CardNumber]]
            );

            $this->assertFalse($validator->passes(), "Card number {$card} should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['card_number' => '4532015112830367'],
            ['card_number' => [new CardNumber]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('card_number', $validator->errors()->toArray());
    }
}
