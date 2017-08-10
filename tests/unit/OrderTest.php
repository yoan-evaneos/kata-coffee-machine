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
            [Order::ORANGE_JUICE, 0, 'O::'],
            [Order::ORANGE_JUICE, 1, 'O::'],
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

    /**
     * @test
     */
    public function it_generates_an_instruction_for_extra_hot_beverage()
    {
        $order = new Order(Order::TEA, 0, true);
        $this->assertEquals('Th::', $order->getInstruction());
    }
    
}
