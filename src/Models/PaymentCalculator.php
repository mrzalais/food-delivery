<?php

namespace App\Models;

class PaymentCalculator
{
    public function calculatePaymentByDistance(float $distance): int
    {
        switch ($distance) {
            case $distance < 1:
                return 1;
            case $distance < 5:
                return 3;
            default:
                return 5;
        }
    }
}
