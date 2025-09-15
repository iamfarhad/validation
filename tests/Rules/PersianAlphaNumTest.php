<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\PersianAlphaNum;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class PersianAlphaNumTest extends TestCase
{
    public function test_valid_persian_alpha_num(): void
    {
        $validTexts = [
            'سلام۱۲۳',
            'فارسی ۴۵۶',
            'تست متن ۷۸۹',
            'نام۰',
            'متن۱۲۳ فارسی',
            'آزمایش ۱۲۳۴۵۶۷۸۹۰',
        ];

        foreach ($validTexts as $text) {
            $validator = Validator::make(
                ['text' => $text],
                ['text' => [new PersianAlphaNum()]]
            );

            $this->assertTrue($validator->passes(), "Persian alpha-num text '{$text}' should be valid");
        }
    }

    public function test_invalid_persian_alpha_num(): void
    {
        $invalidTexts = [
            'Hello',              // English text
            'سلام Hello',         // Mixed Persian and English
            'سلام123',            // Persian with English numbers
            '123',                // Only English numbers
            'سلام!',              // Persian with special characters
            'english123',         // English with numbers
            'MIXED text فارسی',   // Mixed languages
        ];

        foreach ($invalidTexts as $text) {
            $validator = Validator::make(
                ['text' => $text],
                ['text' => [new PersianAlphaNum()]]
            );

            $this->assertFalse($validator->passes(), "Text '{$text}' should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['text' => 'Hello123'],
            ['text' => [new PersianAlphaNum()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('text', $validator->errors()->toArray());
    }
}
