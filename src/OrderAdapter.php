<?php

namespace Kata;

/**
 * Class OrderAdapter
 *
 * @package Kata\Test
 **/
class OrderAdapter
{
    public function toDrinkMaker(Order $order, $amount)
    {
        if ((new OrderValidator())->isSatisfiedBy($order, $amount)) {
            return $order->getInstruction();
        }

        return sprintf('M:%.1f', abs($order->getPrice() - $amount));
    }
}
