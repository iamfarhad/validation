<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Address;
use Illuminate\Support\Facades\Validator;
use Iamfarhad\Validation\Tests\TestCase;

class AddressTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new Address();
    }

    public function test_valid_persian_address(): void
    {
        $this->assertTrue($this->rule->passes('address', 'تهران خیابان ولیصعر - تقاطع فاطمی کوچه عبده - پلاک 46'));
    }

    public function test_invalid_persian_address(): void
    {
        $this->assertFalse($this->rule->passes('address', 'تهران خیابان ولیصعر - تقاطع فاطمی کوچه عبده $ - پلاک 46'));
    }

    public function test_valid_persian_address_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'address' => 'تهران خیابان ولیصعر - تقاطع فاطمی کوچه عبده - پلاک 46',
            ],
            [
                'address' => [new Address()],
            ]
        )->passes());
    }

    public function test_invalid_persian_address_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'address' => 'تهران خیابان ولیصعر - تقاطع فاطمی کوچه عبده -$  پلاک 46',
            ],
            [
                'address' => [new Address()],
            ]
        )->passes());
    }

    public function test_failed_persian_address_message(): void
    {
        $validator = Validator::make(
            ['address' => 'تهران خیابان ولیصعر - تقاطع فاطمی کوچه عبده -  $پلاک 46'],
            ['address' => [new Address()]]
        )->errors()->first();

        $this->assertSame('must be a correct address.', $validator);
    }
}
