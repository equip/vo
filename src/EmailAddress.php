<?php

namespace Equip\ValueObject;

use InvalidArgumentException;

class EmailAddress
{
    private $email;

    public function __construct($email)
    {
        if (filter_var($email, \FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Value must be an email address');
        }

        $this->email = $email;
    }

    public function value()
    {
        return $this->email;
    }
}
