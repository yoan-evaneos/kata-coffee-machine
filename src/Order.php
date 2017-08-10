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
    const TEA = 'T';
    const COFFEE = 'C';
    const HOT_CHOCOLATE = 'H';

    const TEA_PRICE = 0.4;
    const COFFEE_PRICE = 0.6;
    const HOT_CHOCOLATE_PRICE = 0.5;

    const SUGAR_MAX_QUANTITY = 2;

    /** @var string */
    private $type;

    /** @var int */
    private $sugarQuantity;

    /** @var bool */
    private $stick;

    private $prices = [
        self::TEA => self::TEA_PRICE,
        self::COFFEE => self::COFFEE_PRICE,
        self::HOT_CHOCOLATE => self::HOT_CHOCOLATE_PRICE,
    ];

    /**
     * Order constructor.
     *
     * @param string $type
     * @param int $sugarQuantity
     */
    public function __construct($type, $sugarQuantity = 0)
    {
        Assert::oneOf(
            $type,
            [self::COFFEE, self::TEA, self::HOT_CHOCOLATE],
            sprintf('Unknown order type %s', $type)
        );

        Assert::lessThanEq(
            $sugarQuantity,
            self::SUGAR_MAX_QUANTITY,
            sprintf(
                'You should not order more than %d sugars ! Think about your diabetes',
                self::SUGAR_MAX_QUANTITY
            )
        );

        $this->type = $type;
        $this->sugarQuantity = $sugarQuantity;
        $this->stick = empty($sugarQuantity) ? false : true;
    }

    /**
     * @return string
     */
    public function getInstruction()
    {
        if ($this->sugarQuantity > 0) {
            return sprintf('%s:%d:%d', $this->type, $this->sugarQuantity, 0);
        }

        return sprintf('%s::', $this->type);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->prices[$this->type];
    }
}
