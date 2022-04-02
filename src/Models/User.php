<?php

namespace App\Models;

class User
{
    private Order $order;

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    //TODO getOrderHistory
}
