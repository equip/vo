<?php

namespace Equip\ValueObject;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase as TestCase;

class TextTest extends TestCase
{
    public function dataValid()
    {
        return [
            // text, regex
            [null, null],
            ['', null],
            ['text', null],
            ['billy bob', '/^[a-z ]+$/i'],
            ['Côte d\'Ivoire', '/^[\pL\pP\pS ]+$/i'],
        ];
    }

    /**
     * @dataProvider dataValid
     */
    public function testValid($text, $regex)
    {
        $vo = new Text($text, $regex);
        $this->assertSame($text, $vo->value());
    }

    public function dataInvalidFormat()
    {
        return [
            ['billy bob', '/^[0-9]+$/i'],
            ['Côte d\'Ivoire', '/^[a-z ]+$/i'],
        ];
    }

    /**
     * @dataProvider dataInvalidFormat
     */
    public function testInvalidFormat($text, $regex)
    {
        $this->setExpectedException(InvalidArgumentException::class);
        $vo = new Text($text, $regex);
    }

    public function dataInvalidType()
    {
        return [
            'array' => [[]],
            'object' => [new \stdClass],
            'int' => [1],
            'float' => [1.234],
            'bool' => [false],
        ];
    }

    /**
     * @dataProvider dataInvalidType
     */
    public function testInvalidType($text)
    {
        $this->setExpectedException(InvalidArgumentException::class);
        $vo = new Text($text);
    }
}
