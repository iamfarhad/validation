<?php

namespace Iamfarhad\Validation\Tests\Rules;

use Iamfarhad\Validation\Rules\Sheba;
use Illuminate\Support\Facades\Validator;
use Iamfarhad\Validation\Tests\TestCase;

class ShebaTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new Sheba();
    }

    public function test_valid_sheba_number(): void
    {
        $this->assertTrue($this->rule->passes('sheba', 'IR930150000001351800087201'));
    }

    public function test_invalid_sheba_number(): void
    {
        $this->assertFalse($this->rule->passes('sheba', 'IR930150000001351800087202'));
    }

    public function test_valid_sheba_number_validator(): void
    {
        $this->assertTrue(Validator::make(
            [
                'sheba' => 'IR930150000001351800087201',
            ],
            [
                'sheba' => [new Sheba()],
            ]
        )->passes());
    }

    public function test_invalid_sheba_number_validator(): void
    {
        $this->assertFalse(Validator::make(
            [
                'sheba' => 'IR930150000001351800087202',
            ],
            [
                'sheba' => [new Sheba()],
            ]
        )->passes());
    }

    public function test_failed_sheba_number_message(): void
    {
        $validator = Validator::make(
            ['sheba' => 'IR930150000001351800087202'],
            ['sheba' => [new Sheba()]]
        )->errors()->first();

        $this->assertSame('must be a sheba number.', $validator);
    }
}
