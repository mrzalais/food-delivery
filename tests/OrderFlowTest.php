<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

class OrderFlowTest extends TestCase
{
    public function testOrderFlow(): void
    {
        $this->assertTrue(true);
        //new Map
        //New order and recipient placed on map
        //Order status is WAITING FOR COURIER
        //Courier assigns themselves to the order and courier location is shown on map
        //Order status is COURIER_GOING_FOR_ORDER
        //Recipient should see approx time total/left
        //Courier picks up order which updates order status
        //Order status is COURIER_GOING_FOR_RECIPIENT
        //Courier reaches recipient
        //Order is marked as complete
        //Order status COMPLETED
        //Courier receives payment
    }
}
