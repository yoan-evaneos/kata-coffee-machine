<?php

namespace Kata\Test;

use Faker\Factory;
use Faker\Generator;
use Kata\Order;
use Kata\OrderValidator;

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
        $this->assertEquals($expected, (string)$order);
    }

    /**
     * @dataProvider generateWrongTestsData
     * @test
     *
     * @param $orderType
     * @param $sugarQuantity
     * @param $expectedExceptionMessage
     */
    public function it_throws_exception_when_the_order_is_wrong($orderType, $sugarQuantity, $expectedExceptionMessage)
    {
        $this->setExpectedException(\InvalidArgumentException::class, $expectedExceptionMessage);

        new Order($orderType, $sugarQuantity);
    }

    /**
    * @test
    */
    public function it_should_not_generate_order_instruction_if_no_money_given()
    {
        $order = new Order(Order::TEA);
        $this->assertFalse(
            (new OrderValidator())->isSatisfiedBy($order, 0)
        );
    }
}
