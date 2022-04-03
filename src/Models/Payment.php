<?php

namespace App\Models;

class Payment
{
    public float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }
}
