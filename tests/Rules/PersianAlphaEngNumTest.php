<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\PersianAlphaEngNum;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class PersianAlphaEngNumTest extends TestCase
{
    public function test_valid_persian_alpha_eng_num(): void
    {
        $validTexts = [
            'سلام123',
            'فارسی 456',
            'تست متن 789',
            'نام0',
            'متن123 فارسی',
            'آزمایش 1234567890',
            'فارسی',          // Only Persian
            '123',            // Only English numbers
            'فارسی text 123', // Mixed Persian, English text and numbers
        ];

        foreach ($validTexts as $text) {
            $validator = Validator::make(
                ['text' => $text],
                ['text' => [new PersianAlphaEngNum()]]
            );

            $this->assertTrue($validator->passes(), "Persian alpha-eng-num text '{$text}' should be valid");
        }
    }

    public function test_invalid_persian_alpha_eng_num(): void
    {
        $invalidTexts = [
            'سلام!',              // Persian with special characters
            'سلام۱۲۳',            // Persian with Persian numbers (should be invalid)
            'text@domain.com',    // Email format
            'سلام#hashtag',       // Persian with hashtag
            'فارسی & english',    // Persian with ampersand
        ];

        foreach ($invalidTexts as $text) {
            $validator = Validator::make(
                ['text' => $text],
                ['text' => [new PersianAlphaEngNum()]]
            );

            $this->assertFalse($validator->passes(), "Text '{$text}' should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['text' => 'سلام!'],
            ['text' => [new PersianAlphaEngNum()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('text', $validator->errors()->toArray());
    }
}
