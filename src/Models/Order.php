<?php

namespace App\Models;

class Order
{
    public array $coordinates;
    private int $x;
    private int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->coordinates = ['x' => $x, 'y' => $y];
    }
}
