<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Url;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class UrlTest extends TestCase
{
    public function test_valid_urls(): void
    {
        $validUrls = [
            'https://www.example.com',
            'http://example.com',
            'https://subdomain.example.com',
            'https://example.com/path',
            'https://example.com/path?query=value',
            'ftp://files.example.com',
            'https://localhost:8080',
            'https://192.168.1.1',
        ];

        foreach ($validUrls as $url) {
            $validator = Validator::make(
                ['url' => $url],
                ['url' => [new Url()]]
            );

            $this->assertTrue($validator->passes(), "URL '{$url}' should be valid");
        }
    }

    public function test_invalid_urls(): void
    {
        $invalidUrls = [
            'not-a-url',
            'www.example.com',      // Missing protocol
            'example',              // Not a complete URL
            'http://',              // Incomplete URL
            'https://.',            // Invalid domain
            'javascript:void(0)',   // JavaScript protocol (might be valid depending on filter)
            'invalid-url-format',   // Invalid format
        ];

        foreach ($invalidUrls as $url) {
            $validator = Validator::make(
                ['url' => $url],
                ['url' => [new Url()]]
            );

            $this->assertFalse($validator->passes(), "URL '{$url}' should be invalid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['url' => 'not-a-url'],
            ['url' => [new Url()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('url', $validator->errors()->toArray());
    }
}
