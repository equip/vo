<?php

namespace Equip\ValueObject;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase as TestCase;

class BooleanTest extends TestCase
{
    public function dataValid()
    {
        return [
            // value, expected
            'bool true' => [true, true],
            'bool false' => [false, false],
            'int true' => [1, true],
            'int false' => [0, false],
            'str true' => ['1', true],
            'str false' => ['0', false],
            'yes true' => ['yes', true],
            'no false' => ['no', false],
            'on true' => ['on', true],
            'off false' => ['off', false],
            'empty false' => ['', false],
        ];
    }
    /**
     * @dataProvider dataValid
     */
    public function testValid($value, $expected)
    {
        $vo = new Boolean($value);
        $this->assertSame($expected, $vo->value());
    }

    public function dataInvalid()
    {
        return [
            'string' => ['nope'],
            'int' => [11111],
            'float' => [0.123],
            'array' => [[]],
            'object' => [new \stdClass],
        ];
    }

    /**
     * @dataProvider dataInvalid
     */
    public function testInvalid($value)
    {
        $this->setExpectedException(InvalidArgumentException::class);
        $vo = new Boolean($value);
    }

    public function testDefault()
    {
        $vo = new Boolean(null, false);
        $this->assertFalse($vo->value());

        $vo = new Boolean(null, true);
        $this->assertTrue($vo->value());
    }
}
