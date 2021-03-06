<?php

namespace Equip\ValueObject;

use InvalidArgumentException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class PhoneNumber
{
    /**
     * @var libphonenumber\PhoneNumber|null
     */
    private $number;

    public function __construct($number, $is_required = true)
    {
        static $empty_values = [null, ''];

        if (!$is_required && in_array($number, $empty_values, true)) {
            $number = null;
        } elseif (!is_string($number)) {
            throw new InvalidArgumentException('Value must be a phone number');
        } else {
            $number = $this->util()->parse($number, $this->preferredRegion());

            // Parsing does not ensure a valid phone number format, it only ensures
            // a general level of consistency in the numbers and sets a region.

            if (!$this->util()->isValidNumber($number)) {
                throw new InvalidArgumentException('Value must be a valid phone number for the region');
            }
        }

        $this->number = $number;
    }

    public function value()
    {
        if ($this->number) {
            return $this->util()->format($this->number, $this->preferredFormat());
        }

        return null;
    }

    protected function util()
    {
        return PhoneNumberUtil::getInstance();
    }

    protected function preferredRegion()
    {
        return PhoneNumberUtil::UNKNOWN_REGION;
    }

    protected function preferredFormat()
    {
        return PhoneNumberFormat::E164;
    }
}
