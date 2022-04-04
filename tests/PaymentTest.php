<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Payment;
use PHPUnit\Framework\TestCase;
use App\Factories\CourierFactory;

class PaymentTest extends TestCase
{
    public function testItCanBePaidOutToCourier(): void
    {
        $payment = new Payment(5.0);
        $courierFactory = new CourierFactory;
        $courier = $courierFactory->newCourier();

        $this->assertEquals(0, $courier->getBalance());

        $courier->receivePayment($payment);

        $this->assertEquals(5.0, $courier->getBalance());
    }
}
