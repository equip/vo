<?php

namespace Equip\ValueObject;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase as TestCase;

class IdentifierTest extends TestCase
{
    public function dataValid()
    {
        return [
            'integer' => [1],
            'string' => ['2'],
            'octal' => [0x1a8], // 424
        ];
    }

    /**
     * @dataProvider dataValid
     */
    public function testValid($id)
    {
        $vo = new Identifier($id);
        $this->assertEquals($id, $vo->value());
    }

    public function dataNullable()
    {
        return [
            'null' => [null],
            'integer' => [0],
            'string' => ['0'],
        ];
    }

    /**
     * @dataProvider dataNullable
     */
    public function testNullable($id)
    {
        $vo = new Identifier($id, false);
        $this->assertNull($vo->value());
    }

    public function dataInvalid()
    {
        return [
            'null' => [null],
            'zero' => [0],
            'false' => [false],
            'negative' => [-1],
            'object' => [new \stdClass],
            'array' => [[1]],
            'string' => ['bad'],
        ];
    }

    /**
     * @dataProvider dataInvalid
     */
    public function testInvalid($id)
    {
        $this->setExpectedException(InvalidArgumentException::class);

        $id = new Identifier($id);
    }
}
