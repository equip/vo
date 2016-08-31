<?php

namespace Equip\ValueObject;

use InvalidArgumentException;

class EmailAddress
{
    /**
     * @var string|null
     */
    private $email;

    public function __construct($email, $is_required = true)
    {
        static $empty_values = [null, ''];

        if (!$is_required && in_array($email, $empty_values, true)) {
            $email = null;
        } elseif (filter_var($email, \FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Value must be an email address');
        }

        $this->email = $email;
    }

    public function value()
    {
        return $this->email;
    }
}
