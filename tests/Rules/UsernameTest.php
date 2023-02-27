<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Username;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class UsernameTest extends TestCase
{
    private Username $username;

    protected function setUp(): void
    {
        parent::setUp();

        $this->username = new Username();
    }

    public function test_valid_username(): void
    {
        $this->assertTrue($this->username->passes('username', 'farhadzand'));
    }

    public function test_invalid_username(): void
    {
        $this->assertFalse($this->username->passes('username', 'farhad.zand'));
    }

    public function test_valid_username_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'username' => 'farhadzand',
            ],
            [
                'username' => [new Username()],
            ]
        )->passes());
    }

    public function test_invalid_username_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'username' => 'farhad.zand',
            ],
            [
                'username' => [new Username()],
            ]
        )->passes());
    }

    public function test_failed_username_message(): void
    {
        $validator = Validator::make(
            ['username' => 'farhad.zand'],
            ['username' => [new Username()]]
        )->errors()->first();

        $this->assertSame('invalid format.', $validator);
    }
}
