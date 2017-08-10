<?php

namespace Kata\Test;

use Kata\Order;
use Kata\OrderValidator;

/**
 * Class OrderTest
 *
 * @package Kata\Test
 **/
class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function generateTestsData()
    {
        return [
            [Order::COFFEE, 0, 'C::'],
            [Order::COFFEE, 1, 'C:1:0'],
            [Order::COFFEE, 2, 'C:2:0'],
            [Order::TEA, 0, 'T::'],
            [Order::TEA, 1, 'T:1:0'],
            [Order::TEA, 2, 'T:2:0'],
            [Order::HOT_CHOCOLATE, 0, 'H::'],
            [Order::HOT_CHOCOLATE, 1, 'H:1:0'],
            [Order::HOT_CHOCOLATE, 2, 'H:2:0'],
        ];
    }

    /**
     * @return array
     */
    public function generateWrongTestsData()
    {
        return [
            ['Soup', 0, 'Unknown order type Soup'],
            [
                Order::COFFEE,
                3,
                sprintf(
                    'You should not order more than %s sugars ! Think about your diabetes',
                    Order::SUGAR_MAX_QUANTITY
                ),
            ],
        ];
    }

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
     * @dataProvider generateTestsData
     * @test
     *
     * @param string $orderType
     * @param int $sugarQuantity
     * @param string $expected
     */
    public function it_generates_the_correct_instruction_for_a_an_order($orderType, $sugarQuantity, $expected)
    {
        $order = new Order($orderType, $sugarQuantity);
        $this->assertEquals($expected, $order->getInstruction());
    }

    /**
     * @dataProvider generateWrongTestsData
     * @test
     *
     * @param string $orderType
     * @param int $sugarQuantity
     * @param string $expectedExceptionMessage
     */
    public function it_throws_exception_when_the_order_is_wrong($orderType, $sugarQuantity, $expectedExceptionMessage)
    {
        $this->setExpectedException(\InvalidArgumentException::class, $expectedExceptionMessage);

        new Order($orderType, $sugarQuantity);
    }

}
