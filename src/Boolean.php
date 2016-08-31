<?php

namespace Equip\ValueObject;

use InvalidArgumentException;

use function Assert\that;

class Boolean
{
    /**
     * @var bool|null
     */
    private $value;

    public function __construct($value, $default = null)
    {
        if ($value === null) {
            $value = $default;
        }

        that($value)->nullOr()->scalar();

        $options = [
            'flags' => \FILTER_NULL_ON_FAILURE,
        ];

        $value = filter_var($value, \FILTER_VALIDATE_BOOLEAN, $options);

        that($value)->boolean();

        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }
}
