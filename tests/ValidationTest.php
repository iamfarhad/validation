<?php

use PHPUnit\Framework\TestCase;
use Iamfarhad\Validation\Contracts\ValidationRuleInterface;

class ValidationTest extends TestCase
{
    public $attribute;

    public $value;

    public $parameter;

    public $validator;


    public function testPersianNumber()
    {
        $persianNumberExtension = new \Iamfarhad\Validation\Rules\PersianNumber();

        $this->assertInstanceOf(ValidationRuleInterface::class, $persianNumberExtension);

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

    public function testPersianAlphabet()
    {
        $persianAlphabetExtension = new \Iamfarhad\Validation\Rules\PersianAlpha();

        $this->assertInstanceOf(ValidationRuleInterface::class, $persianAlphabetExtension);

        // success test
        $this->value = 'سلام دنیا';
        $this->assertEquals(true, $persianAlphabetExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = 'hello world!';
        $this->assertEquals(false, $persianAlphabetExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = 'سلام دنیا.';
        $this->assertEquals(false, $persianAlphabetExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));


        // fail test
        $this->value = 'سلام دنیا hello world';
        $this->assertEquals(false, $persianAlphabetExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testPersianAlphabetNumber()
    {
        $persianAlphabetNumberExtension = new \Iamfarhad\Validation\Rules\PersianAlphabetNumber();

        $this->assertInstanceOf(ValidationRuleInterface::class, $persianAlphabetNumberExtension);

        // success test
        $this->value = 'سلام دنیا ۴۵۶۷';
        $this->assertEquals(true, $persianAlphabetNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = 'سلام دنیا 125874';
        $this->assertEquals(false, $persianAlphabetNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testIranAddress()
    {
        $iranAddressExtension = new \Iamfarhad\Validation\Rules\IranAddress();

        $this->assertInstanceOf(ValidationRuleInterface::class, $iranAddressExtension);

        // success test
        $this->value = 'تهران خیابان ولیصعر - تقاطع فاطمی کوچه عبده - پلاک 46';
        $this->assertEquals(true, $iranAddressExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        /*
         * fail test
         * fail with &
         */
        $this->value = 'تهران خیابان ولیصعر - تقاطع فاطمی کوچه عبده - پلاک 46 & ساختمان ایران رنتر';
        $this->assertEquals(false, $iranAddressExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testIranMobile()
    {
        $IranMobileExtension = new \Iamfarhad\Validation\Rules\IranMobile();
    }
}
