<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\PaymentCalculator;

class PaymentCalculatorTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testItShouldReturnCorrectAmountBasedOnDistance(float $distance, float $result): void
    {
        $paymentCalculator = new PaymentCalculator;
        $amount = $paymentCalculator->calculatePayment($distance);

        $this->assertEquals($result, $amount);
    }

    public function provider(): array
    {
        return [
            [
                'distance' => 0.5,
                'result' => 1.0,
            ],
            [
                'distance' => 0.99,
                'result' => 1.0,
            ],
            [
                'distance' => 1,
                'result' => 3.0,
            ],
            [
                'distance' => 2,
                'result' => 3.0,
            ],
            [
                'distance' => 3,
                'result' => 3.0,
            ],
            [
                'distance' => 4,
                'result' => 3.0,
            ],
            [
                'distance' => 4.99,
                'result' => 3.0,
            ],
            [
                'distance' => 5,
                'result' => 5.0,
            ],
            [
                'distance' => 6,
                'result' => 5.0,
            ],
        ];
    }
}
