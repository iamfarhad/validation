<?php

use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    public $attribute;

    public $value;

    public $parameter;

    public $validator;


    public function testPersianNumber()
    {
        $persianNumberExtension = new \Iamfarhad\Validation\Rules\PersianNumber();

        // success test
        $this->value = '۴۵۶۷';
        $this->assertEquals(true, $persianNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = 12233;
        $this->assertEquals(false, $persianNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '۴۵۶۷90';
        $this->assertEquals(false, $persianNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '-۴۵۶۷90';
        $this->assertEquals(false, $persianNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '+۴۵۶۷90';
        $this->assertEquals(false, $persianNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }
}
