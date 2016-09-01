<?php

namespace Equip\ValueObject;

use function Assert\that;

class Identifier
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @param int|null $id
     * @param boolean $is_required
     */
    public function __construct($id, $is_required = true)
    {
        $assert = that($id);

        if (!$is_required) {
            $assert->nullOr();
        }

        $assert->integer()->greaterThan(0);

        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function value()
    {
        return $this->id;
    }
}
