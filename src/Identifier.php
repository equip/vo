<?php

namespace Equip\ValueObject;

use InvalidArgumentException;

use function Assert\that;

class Identifier
{
    /**
     * @var int|null
     */
    private $id;

    public function __construct($id, $is_required = true)
    {
        $assert = that($id);

        if (!$is_required) {
            $assert->nullOr();
        }

        $assert->integer()->greaterThan(0);

        $this->id = $id;
    }

    public function value()
    {
        return $this->id;
    }
}
