<?php

namespace Equip\ValueObject;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase as TestCase;

class EmailAddressTest extends TestCase
{
    public function testValid()
    {
        $email = 'user@example.com';
        $vo = new EmailAddress($email);
        $this->assertSame($email, $vo->value());
    }

    public function testNotRequired()
    {
        $email = null;
        $vo = new EmailAddress($email, false);

        $this->assertNull($vo->value());
    }

    public function dataInvalid()
    {
        return [
            'invalid string' => ['not an email address'],
            'array' => [[]],
            'object' => [new \stdClass],
        ];
    }

    /**
     * @dataProvider dataInvalid
     */
    public function testInvalid($email)
    {
        $this->setExpectedException(InvalidArgumentException::class);
        $vo = new EmailAddress($email);
    }
}
