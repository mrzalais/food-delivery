<?php

namespace App\Models;

class PaymentCalculator
{
    public function calculatePayment(float $distance): float
    {
        switch ($distance) {
            case $distance < 1:
                return 1.0;
            case $distance < 5:
                return 3.0;
            default:
                return 5.0;
        }
    }
}
