<?php

namespace Equip\ValueObject;

use InvalidArgumentException;

use function Assert\that;

class Text
{
    /**
     * @var string|null
     */
    private $value;

    public function __construct($value, $regex = null)
    {
        $assert = that($value)->nullOr()->string();

        if ($regex) {
            $assert->regex($regex);
        }

        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }
}
