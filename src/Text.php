<?php

namespace Equip\ValueObject;

use function Assert\that;

class Text
{
    /**
     * @var string|null
     */
    private $value;

    /**
     * @param string|null $value
     * @param string|null $regex
     */
    public function __construct($value, $regex = null)
    {
        $assert = that($value)->nullOr()->string();

        if ($regex) {
            $assert->regex($regex);
        }

        $this->value = $value;
    }

    /**
     * @return string|null
     */
    public function value()
    {
        return $this->value;
    }
}
