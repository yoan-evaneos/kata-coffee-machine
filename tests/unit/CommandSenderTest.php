<?php

namespace Kata\Test;

use Kata\Order;

/**
 * Class DrinkMakerTest
 *
 * @package Kata\Test
 **/
class CommandSenderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Set up the Unit Test
     */
    public function setUp()
    {
    }

    /**
     *
     */
    public function tearDown()
    {
    }

    /**
     * @test
     */
    public function it_should_generate_the_correct_instruction_for_a_coffee_order()
    {
        $order = new Order(Order::COFFEE);

        $this->assertEquals('C::', (string)$order);
    }

    /**
     * @test
     */
    public function it_should_generate_the_correct_instruction_for_a_coffee_with_one_sugar_order()
    {
        $order = new Order(Order::COFFEE, 1);

        $this->assertEquals('C:1:0', (string)$order);
    }

    /**
     * @test
     */
    public function it_should_generate_the_correct_instruction_for_a_coffee_with_two_sugars_order()
    {
        $order = new Order(Order::COFFEE, 2);

        $this->assertEquals('C:2:0', (string)$order);
    }
    
    /**
     * @test
     */
    public function it_should_generate_the_correct_instruction_for_a_coffee_with_more_than_two_sugars_order()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        new Order(Order::COFFEE, 3);
    }

    /**
     * @test
     */
    public function it_should_generate_the_correct_instruction_for_a_tea_order()
    {
        $order = new Order(Order::TEA);
        $this->assertEquals('T::', (string)$order);
    }

    /**
     * @test
     */
    public function it_should_generate_the_correct_instruction_for_a_tea_with_one_sugar_order()
    {
        $order = new Order(Order::TEA, 1);
        $this->assertEquals('T:1:0', (string) $order);
    }

    /**
     * @test
     */
    public function it_should_generate_the_correct_instruction_for_a_tea_with_two_sugars_order()
    {
        $order = new Order(Order::TEA, 2);
        $this->assertEquals('T:2:0', (string) $order);
    }

    /**
     * @test
     */
    public function it_should_generate_the_correct_instruction_for_a_hot_chocolate_order()
    {
        $order = new Order(Order::HOT_CHOCOLATE);
        $this->assertEquals('H::', (string)$order);
    }

    /**
     * @test
     */
    public function it_should_generate_the_correct_instruction_for_a_hot_chocolate_with_one_sugar_order()
    {
        $order = new Order(Order::HOT_CHOCOLATE, 1);
        $this->assertEquals('H:1:0', (string)$order);
    }

    /**
     * @test
     */
    public function it_should_generate_the_correct_instruction_for_a_hot_chocolate_with_two_sugars_order()
    {
        $order = new Order(Order::HOT_CHOCOLATE, 2);
        $this->assertEquals('H:2:0', (string)$order);
    }
}
