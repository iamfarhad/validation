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
        $this->assertTrue($persianNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = 12233;
        $this->assertFalse($persianNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '۴۵۶۷90';
        $this->assertFalse($persianNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '-۴۵۶۷90';
        $this->assertFalse($persianNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '+۴۵۶۷90';
        $this->assertFalse($persianNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testPersianAlphabet()
    {
        $persianAlphabetExtension = new \Iamfarhad\Validation\Rules\PersianAlpha();

        $this->assertInstanceOf(ValidationRuleInterface::class, $persianAlphabetExtension);

        // success test
        $this->value = 'سلام دنیا';
        $this->assertTrue($persianAlphabetExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = 'hello world!';
        $this->assertFalse($persianAlphabetExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = 'سلام دنیا.';
        $this->assertFalse($persianAlphabetExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));


        // fail test
        $this->value = 'سلام دنیا hello world';
        $this->assertFalse($persianAlphabetExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testPersianAlphabetNumber()
    {
        $persianAlphabetNumberExtension = new \Iamfarhad\Validation\Rules\PersianAlphabetNumber();

        $this->assertInstanceOf(ValidationRuleInterface::class, $persianAlphabetNumberExtension);

        // success test
        $this->value = 'سلام دنیا ۴۵۶۷';
        $this->assertTrue($persianAlphabetNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = 'سلام دنیا 125874';
        $this->assertFalse($persianAlphabetNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testIranAddress()
    {
        $iranAddressExtension = new \Iamfarhad\Validation\Rules\IranAddress();

        $this->assertInstanceOf(ValidationRuleInterface::class, $iranAddressExtension);

        // success test
        $this->value = 'تهران خیابان ولیصعر - تقاطع فاطمی کوچه عبده - پلاک 46';
        $this->assertTrue($iranAddressExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        /*
         * fail test
         * fail with &
         */
        $this->value = 'تهران خیابان ولیصعر - تقاطع فاطمی کوچه عبده - پلاک 46 & ساختمان ایران رنتر';
        $this->assertFalse($iranAddressExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testIranPostalCode()
    {
        $iranPostalCodeExtension = new \Iamfarhad\Validation\Rules\IranPostalCode();

        $this->assertInstanceOf(ValidationRuleInterface::class, $iranPostalCodeExtension);

        // success test
        $this->value = '6385141552';
        $this->assertTrue($iranPostalCodeExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // success test
        $this->value = '63851-41552';
        $this->assertTrue($iranPostalCodeExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '638514155';
        $this->assertFalse($iranPostalCodeExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '63851415522';
        $this->assertFalse($iranPostalCodeExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '63851-4155';
        $this->assertFalse($iranPostalCodeExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '6385-41552';
        $this->assertFalse($iranPostalCodeExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testIranMobile()
    {
        $IranMobileExtension = new \Iamfarhad\Validation\Rules\IranMobile();

        $this->assertInstanceOf(ValidationRuleInterface::class, $IranMobileExtension);

        // success test
        $this->value = '09120724013';
        $this->assertTrue($IranMobileExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // success test
        $this->value = '989120724013';
        $this->assertTrue($IranMobileExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // success test
        $this->value = '+989120724013';
        $this->assertTrue($IranMobileExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // success test
        $this->value = '00989120724013';
        $this->assertTrue($IranMobileExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // success test
        $this->value = '9120724013';
        $this->assertTrue($IranMobileExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '0912072401';
        $this->assertFalse($IranMobileExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '+980912072401';
        $this->assertFalse($IranMobileExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '00980912072401';
        $this->assertFalse($IranMobileExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testIranPhone()
    {
        $iranPhoneExtension = new \Iamfarhad\Validation\Rules\IranPhone();

        $this->assertInstanceOf(ValidationRuleInterface::class, $iranPhoneExtension);

        // success test
        $this->value = '44614785';
        $this->assertTrue($iranPhoneExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '4461478';
        $this->assertFalse($iranPhoneExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '446147877';
        $this->assertFalse($iranPhoneExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testIranPhoneWithArea()
    {
        $iranPhoneWithArea = new \Iamfarhad\Validation\Rules\IranPhoneWithArea();

        $this->assertInstanceOf(ValidationRuleInterface::class, $iranPhoneWithArea);

        // success test
        $this->value = '02144614785';
        $this->assertTrue($iranPhoneWithArea->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '2144614785';
        $this->assertFalse($iranPhoneWithArea->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '0214461478';
        $this->assertFalse($iranPhoneWithArea->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testIsNotPersian()
    {
        $isNotPersian = new \Iamfarhad\Validation\Rules\IsNotPersian();

        $this->assertInstanceOf(ValidationRuleInterface::class, $isNotPersian);

        // success test
        $this->value = 'hello world!';
        $this->assertTrue($isNotPersian->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // success test
        $this->value = '0214461478';
        $this->assertTrue($isNotPersian->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = 'سلام دنیا';
        $this->assertFalse($isNotPersian->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '۴۵۶۷';
        $this->assertFalse($isNotPersian->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testMelliCode()
    {
        $melliCodeExtension = new \Iamfarhad\Validation\Rules\MelliCode();

        $this->assertInstanceOf(ValidationRuleInterface::class, $melliCodeExtension);

        // success test
        $this->value = '0112169228';
        $this->assertTrue($melliCodeExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '0112169227';
        $this->assertFalse($melliCodeExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testShebaNumber()
    {
        $shebaNumberExtension = new \Iamfarhad\Validation\Rules\ShebaNumber();

        $this->assertInstanceOf(ValidationRuleInterface::class, $shebaNumberExtension);

        // success test
        $this->value = 'IR930150000001351800087201';
        $this->assertTrue($shebaNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '930150000001351800087201';
        $this->assertFalse($shebaNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = 'IR930150000001351800087202';
        $this->assertFalse($shebaNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }

    public function testCardNumber()
    {
        $cardNumberExtension = new \Iamfarhad\Validation\Rules\CardNumber();

        $this->assertInstanceOf(ValidationRuleInterface::class, $cardNumberExtension);

        // success test
        $this->value = '0590995099116037';
        $this->assertTrue($cardNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '0590995099116038';
        $this->assertFalse($cardNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '059099509911603';
        $this->assertFalse($cardNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));

        // fail test
        $this->value = '05909950991160355';
        $this->assertFalse($cardNumberExtension->rule($this->attribute, $this->value, $this->parameter, $this->value));
    }
}
