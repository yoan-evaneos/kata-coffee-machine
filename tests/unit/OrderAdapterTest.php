<?php

namespace Kata\Test;

use Kata\Order;
use Kata\OrderAdapter;

/**
 * Class OrderAdapterTest
 *
 * @package Kata\Test
 **/
class OrderAdapterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function generateTestsData()
    {
        return [
            [new Order(Order::TEA), 0, 'M:0.4', 'It missing 0.4€ when a tea is ordered'],
            [new Order(Order::TEA), 2, 'T::', 'It should order a tea without sugar and stick when 0.4€ is given'],
            [new Order(Order::COFFEE), 0, 'M:0.6', 'It missing 0.6€ when a coffee is ordered'],
            [new Order(Order::COFFEE), 0.6, 'C::', 'It should order a coffee without sugar and stick when 0.6€ is given'],
            [new Order(Order::COFFEE), 2, 'C::', 'It should order a coffee without sugar and stick when 0.6€ is given (et on ne rend pas la monnaie)'],
            [new Order(Order::HOT_CHOCOLATE), 0, 'M:0.5', 'It missing 0.5€ when a  hot chocolate is ordered'],
            [new Order(Order::HOT_CHOCOLATE), 2, 'H::', 'It should order a hot chocolate without sugar and stick when 0.5€ is given (et on ne rend pas la monnaie)\''],
        ];
    }

    /**
     * @test
     */
    public function it_should_return_a_message_instruction_if_not_enough_money()
    {
        $order = new Order(Order::TEA, 0);
        $instruction = (new OrderAdapter())->toDrinkMaker($order, 0);
        $this->assertEquals('M:0.4', $instruction);
    }

    /**
     * @dataProvider generateTestsData
     * @test
     *
     * @param Order $order
     * @param float $amount
     * @param string $expectedMessage
     * @param string $errorMessage
     */
    public function it_should_return_a_correct_message_instruction(
        Order $order,
        $amount,
        $expectedMessage,
        $errorMessage
    ) {
        $instruction = (new OrderAdapter())->toDrinkMaker($order, $amount);
        $this->assertEquals($expectedMessage, $instruction, $errorMessage);
    }
}
