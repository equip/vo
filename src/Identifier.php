<?php

namespace Equip\ValueObject;

use InvalidArgumentException;

class Identifier
{
    /**
     * @var int|null
     */
    private $id;

    public function __construct($id, $is_required = true)
    {
        static $empty_values = [null, false, 0, '0', ''];

        if (in_array($id, $empty_values, true) && !$is_required) {
            $id = null;
        } else {
            $options = [
                'flags' => \FILTER_REQUIRE_SCALAR,
                'options' => [
                    'min_range' => 1,
                ],
            ];

            if (filter_var($id, \FILTER_VALIDATE_INT, $options) === false) {
                throw new InvalidArgumentException('Value must be a valid identifier');
            }

            $id = (int) $id;
        }

        $this->id = $id;
    }

    public function value()
    {
        return $this->id;
    }
}
