<?php

namespace Kata\Test;

use Kata\Order;
use Kata\OrderAdapter;
use Kata\OrderValidator;

/**
 * Class DrinkMakerTest
 *
 * @package Kata\Test
 **/
class OrderValidatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function generatePriceTestsData()
    {
        return [
            [new Order(Order::TEA), 0, false],
            [new Order(Order::TEA), -1, false],
            [new Order(Order::TEA), 2, true],
            [new Order(Order::COFFEE), 0, false],
            [new Order(Order::COFFEE), 0.6, true],
            [new Order(Order::COFFEE), 2, true],
            [new Order(Order::HOT_CHOCOLATE), 0, false],
            [new Order(Order::HOT_CHOCOLATE), 2, true],
        ];
    }

    /**
     * @test
     */
    public function it_should_not_generate_order_instruction_if_no_money_is_given()
    {
        $order = new Order(Order::TEA);
        $this->assertFalse(
            (new OrderValidator())->isSatisfiedBy($order, 0)
        );
    }

    /**
     * @dataProvider generatePriceTestsData
     * @test
     *
     * @param Order $order
     * @param float $moneyAmount
     * @param bool $expected
     */
    public function it_should_generate_instruction_if_enough_money_is_given(Order $order, $moneyAmount, $expected)
    {
        $this->assertEquals($expected, (new OrderValidator())->isSatisfiedBy($order, $moneyAmount));
    }
}
