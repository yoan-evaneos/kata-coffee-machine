<?php

namespace Kata;

class OrderValidator
{


    /**
     * @param Order $order
     * @param float $money
     *
     * @return bool
     */
    public function isSatisfiedBy(Order $order, $money)
    {
        return $money >= $order->getPrice();
    }
}
