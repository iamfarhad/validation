<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Username;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class UsernameTest extends TestCase
{
    public function test_valid_usernames(): void
    {
        $validUsernames = [
            'user123',
            'test_user',
            'my-username',
            'a',
            'user_name_123',
            'test-user-name',
            'username123_test',
        ];

        foreach ($validUsernames as $username) {
            $validator = Validator::make(
                ['username' => $username],
                ['username' => [new Username]]
            );

            $this->assertTrue($validator->passes(), "Username '{$username}' should be valid");
        }
    }

    public function test_invalid_usernames(): void
    {
        $invalidUsernames = [
            '123user',         // Starts with number
            '_username',       // Starts with underscore
            '-username',       // Starts with dash
            'user name',       // Contains space
            'user@name',       // Contains special character
            'user.name',       // Contains dot
        ];

        foreach ($invalidUsernames as $username) {
            $validator = Validator::make(
                ['username' => $username],
                ['username' => [new Username]]
            );

            $this->assertFalse($validator->passes(), "Username '{$username}' should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['username' => '123user'],
            ['username' => [new Username]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('username', $validator->errors()->toArray());
    }
}
