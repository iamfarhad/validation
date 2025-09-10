<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\PersianAlpha;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class PersianAlphaTest extends TestCase
{
    public function test_valid_persian_text(): void
    {
        $validTexts = [
            'سلام',
            'فارسی',
            'تست متن فارسی',
            'نام و نام خانوادگی',
            'متن با فاصله',
        ];

        foreach ($validTexts as $text) {
            $validator = Validator::make(
                ['text' => $text],
                ['text' => [new PersianAlpha]]
            );

            $this->assertTrue($validator->passes(), "Persian text '{$text}' should be valid");
        }
    }

    public function test_invalid_persian_text(): void
    {
        $invalidTexts = [
            'Hello',           // English text
            'سلام Hello',      // Mixed Persian and English
            'سلام123',         // Persian with numbers
            '123',             // Only numbers
            'سلام!',           // Persian with special characters
        ];

        foreach ($invalidTexts as $text) {
            $validator = Validator::make(
                ['text' => $text],
                ['text' => [new PersianAlpha]]
            );

            $this->assertFalse($validator->passes(), "Text '{$text}' should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['text' => 'Hello'],
            ['text' => [new PersianAlpha]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('text', $validator->errors()->toArray());
    }
}
