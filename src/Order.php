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
    const ORANGE_JUICE = 'O';

    const TEA_PRICE = 0.4;
    const COFFEE_PRICE = 0.6;
    const HOT_CHOCOLATE_PRICE = 0.5;
    const ORANGE_JUICE_PRICE = 0.6;

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
        self::ORANGE_JUICE => self::ORANGE_JUICE_PRICE,
    ];
    /**
     * @var bool
     */
    private $extraHot;

    /**
     * Order constructor.
     *
     * @param string $type
     * @param int $sugarQuantity
     * @param bool $extraHot
     */
    public function __construct($type, $sugarQuantity = 0, $extraHot = false)
    {
        Assert::oneOf(
            $type,
            [self::COFFEE, self::TEA, self::HOT_CHOCOLATE, self::ORANGE_JUICE],
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
        $this->sugarQuantity = $type !== self::ORANGE_JUICE ? $sugarQuantity : 0;
        $this->stick = empty($sugarQuantity) ? false : true;
        $this->extraHot = $extraHot;
    }

    /**
     * @return string
     */
    public function getInstruction()
    {
        $isExtraHot = $this->extraHot ? 'h' : '';
        
        if ($this->sugarQuantity > 0) {
            return sprintf('%s%s:%d:%d', $this->type, $isExtraHot, $this->sugarQuantity, 0);
        }

        return sprintf('%s%s::', $this->type, $isExtraHot);
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
