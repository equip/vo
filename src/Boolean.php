<?php

namespace Equip\ValueObject;

use InvalidArgumentException;

class Boolean
{
    private $value;

    public function __construct($value, $default = null)
    {
        static $empty_values = [null, ''];

        if (is_bool($default) && in_array($value, $empty_values, true)) {
            $value = $default;
        }

        if (!is_scalar($value)) {
            throw new InvalidArgumentException('Value must a possible boolean');
        }

        $options = [
            'flags' => \FILTER_NULL_ON_FAILURE,
        ];

        $value = filter_var($value, \FILTER_VALIDATE_BOOLEAN, $options);

        if ($value === null) {
            throw new InvalidArgumentException('Value must be boolean');
        }

        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }
}
