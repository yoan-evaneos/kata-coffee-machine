<?php

namespace Kata\Test;

use Faker\Factory;
use Faker\Generator;
use Kata\Order;

/**
 * Class DrinkMakerTest
 *
 * @package Kata\Test
 **/
class CommandSenderTest extends \PHPUnit_Framework_TestCase
{
    /** @var Generator */
    private $faker;

    /**
     * Set up the Unit Test
     */
    public function setUp()
    {
        $this->faker = Factory::create();
    }

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
            [Order::HOT_CHOCOLATE, 2, 'H:2:0']
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
    public function it_should_generate_the_correct_instruction_for_a_an_order($orderType, $sugarQuantity, $expected)
    {
        $order = new Order($orderType, $sugarQuantity);
        $this->assertEquals($expected, (string) $order);
    }

    /**
     * @test
     */
    public function it_should_generate_the_correct_instruction_for_a_coffee_with_more_than_two_sugars_order()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        new Order(Order::COFFEE, 3);
    }
}
