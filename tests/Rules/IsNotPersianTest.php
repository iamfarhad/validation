<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\IsNotPersian;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class IsNotPersianTest extends TestCase
{
    public function test_valid_non_persian_text(): void
    {
        $validTexts = [
            'Hello World',
            'English text only',
            '1234567890',
            'Special characters !@#$%^&*()',
            'Mixed English and numbers 123',
        ];

        foreach ($validTexts as $text) {
            $validator = Validator::make(
                ['text' => $text],
                ['text' => [new IsNotPersian]]
            );

            $this->assertTrue($validator->passes(), "Text '{$text}' should be valid (not Persian)");
        }
    }

    public function test_invalid_persian_text(): void
    {
        $invalidTexts = [
            'سلام',
            'فارسی',
            'Hello سلام',          // Mixed English and Persian
            'Text with Persian: فارسی',
            '123 فارسی',
        ];

        foreach ($invalidTexts as $text) {
            $validator = Validator::make(
                ['text' => $text],
                ['text' => [new IsNotPersian]]
            );

            $this->assertFalse($validator->passes(), "Text '{$text}' should be invalid (contains Persian)");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['text' => 'سلام'],
            ['text' => [new IsNotPersian]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('text', $validator->errors()->toArray());
    }
}
