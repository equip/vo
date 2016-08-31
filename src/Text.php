<?php

namespace Equip\ValueObject;

use InvalidArgumentException;

class Text
{
    private $value;

    public function __construct($value, $regex = null)
    {
        if ($value === null) {
            $value = '';
        }

        if (!is_string($value)) {
            throw new InvalidArgumentException('Value must be a string');
        }

        if ($regex && !preg_match($regex, $value)) {
            throw new InvalidArgumentException('Value must match the expected format');
        }

        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }
}
