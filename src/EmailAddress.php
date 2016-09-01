<?php

namespace Equip\ValueObject;

use function Assert\that;

class EmailAddress
{
    /**
     * @var string|null
     */
    private $email;

    public function __construct($email, $is_required = true)
    {
        $assert = that($email);

        if (!$is_required) {
            $assert->nullOr();
        }

        $assert->scalar()->email();

        $this->email = $email;
    }

    public function value()
    {
        return $this->email;
    }
}
