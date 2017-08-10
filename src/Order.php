<?php

namespace Kata;

use Webmozart\Assert\Assert;

/**
 * Class Order
 *
 * @package Kata
 **/
class Order
{
    const COFFEE = 'C';
    const TEA = 'T';
    const HOT_CHOCOLATE = 'H';
    const SUGAR_MAX_QUANTITY = 2;

    /** @var string */
    private $type;

    /** @var int */
    private $sugarQuantity;

    /** @var bool */
    private $stick;

    /**
     * Order constructor.
     *
     * @param string $type
     * @param int $sugarQuantity
     */
    public function __construct($type, $sugarQuantity = 0)
    {
        Assert::lessThanEq($sugarQuantity, self::SUGAR_MAX_QUANTITY);
        $this->type = $type;
        $this->sugarQuantity = $sugarQuantity;
        $this->stick = empty($sugarQuantity) ? false : true;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if ($this->sugarQuantity > 0) {
            return sprintf('%s:%d:%d', $this->type, $this->sugarQuantity, 0);
        }

        return sprintf('%s::', $this->type);
    }
}
