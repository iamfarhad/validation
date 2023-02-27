<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Base64;
use Iamfarhad\Validation\Rules\Username;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class Base64Test extends TestCase
{
    private Username $username;

    protected function setUp(): void
    {
        parent::setUp();

        $this->base64 = new Base64();
    }

    public function test_valid_base64(): void
    {
        $this->assertTrue($this->base64->passes('base64', 'ZmFyaGFkemFuZA=='));
    }

    public function test_invalid_base64(): void
    {
        $this->assertFalse($this->base64->passes('base64', 'ZmFyaGFkemFuZ'));
    }

    public function test_valid_base64_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'base64' => 'ZmFyaGFkemFuZA==',
            ],
            [
                'base64' => [new Base64()],
            ]
        )->passes());
    }

    public function test_invalid_base64_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'base64' => 'ZmFyaGFkemFuZ',
            ],
            [
                'base64' => [new Base64()],
            ]
        )->passes());
    }

    public function test_failed_base64_message(): void
    {
        $validator = Validator::make(
            ['base64' => 'ZmFyaGFkemFuZ'],
            ['base64' => [new Base64()]]
        )->errors()->first();

        $this->assertSame('invalid base64 format.', $validator);
    }
}
