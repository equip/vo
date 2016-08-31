<?php

namespace Equip\ValueObject;

use InvalidArgumentException;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use PHPUnit_Framework_TestCase as TestCase;

class PhoneNumberTest extends TestCase
{
    public function dataValid()
    {
        $util = PhoneNumberUtil::getInstance();

        return array_map(function ($region) use ($util) {
            return (array) $util->format(
                $util->getExampleNumber($region),
                PhoneNumberFormat::E164
            );
        }, [
            'AU',
            'CH',
            'GB',
            'US',
        ]);
    }

    /**
     * @dataProvider dataValid
     */
    public function testValid($number)
    {
        $vo = new PhoneNumber($number);
        $this->assertSame($number, $vo->value());
    }

    public function testNotRequired()
    {
        $number = '';
        $vo = new PhoneNumber($number, false);

        $this->assertNull($vo->value());
    }

    public function dataInvalidNumbers()
    {
        $util = PhoneNumberUtil::getInstance();

        return array_map(function ($region) use ($util) {
            return (array) $util->format(
                $util->getInvalidExampleNumber($region),
                PhoneNumberFormat::E164
            );
        }, [
            'AU',
            'CH',
            'GB',
            'US',
        ]);
    }

    /**
     * @dataProvider dataInvalidNumbers
     */
    public function testInvalidNumbers($number)
    {
        $this->setExpectedException(InvalidArgumentException::class);
        $vo = new PhoneNumber($number);
    }

    public function dataInvalid()
    {
        return [
            'array' => [[]],
            'object' => [new \stdClass],
            'null' => [null],
        ];
    }

    /**
     * @dataProvider dataInvalid
     */
    public function testInvalid($number)
    {
        $this->setExpectedException(InvalidArgumentException::class);
        $vo = new PhoneNumber($number);
    }
}
