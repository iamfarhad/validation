<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Domain;
use Iamfarhad\Validation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class DomainTest extends TestCase
{
    public function test_valid_domains(): void
    {
        $validDomains = [
            'example.com',
            'subdomain.example.com',
            'www.example.com',
            'test-domain.org',
            'localhost',
            'my-site.co.uk',
            'site123.com',
            'x.co',
        ];

        foreach ($validDomains as $domain) {
            $validator = Validator::make(
                ['domain' => $domain],
                ['domain' => [new Domain()]]
            );

            $this->assertTrue($validator->passes(), "Domain '{$domain}' should be valid");
        }
    }

    public function test_invalid_domains(): void
    {
        $invalidDomains = [
            'invalid-string',       // Invalid format
            'example',              // No TLD (except localhost)
            '.com',                 // Starts with dot
            'example.',             // Ends with dot
            'ex ample.com',         // Contains space
            'example..com',         // Double dots
            '-example.com',         // Starts with hyphen
            'example-.com',         // Ends with hyphen
            'example.c',            // Too short TLD
        ];

        foreach ($invalidDomains as $domain) {
            $validator = Validator::make(
                ['domain' => $domain],
                ['domain' => [new Domain()]]
            );

            $this->assertFalse($validator->passes(), "Domain '{$domain}' should be invalid");
        }
    }

    public function test_domain_with_protocol(): void
    {
        $domainsWithProtocol = [
            'https://example.com',
            'http://www.example.com',
            'https://subdomain.example.com/path',
        ];

        foreach ($domainsWithProtocol as $domain) {
            $validator = Validator::make(
                ['domain' => $domain],
                ['domain' => [new Domain()]]
            );

            $this->assertTrue($validator->passes(), "Domain with protocol '{$domain}' should be valid");
        }
    }

    public function test_validation_error_message(): void
    {
        $validator = Validator::make(
            ['domain' => 'invalid domain'],
            ['domain' => [new Domain()]]
        );

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('domain', $validator->errors()->toArray());
    }
}
