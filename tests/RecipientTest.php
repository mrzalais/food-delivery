<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Order;
use PHPUnit\Framework\TestCase;
use App\Factories\RecipientFactory;

class RecipientTest extends TestCase
{
    public function testItCanHaveAOrder(): void
    {
        $recipientFactory = new RecipientFactory;
        $recipient = $recipientFactory->newRecipient();

        $order = new Order([0, 0], [1, 1]);
        $recipient->setOrder($order);

        $this->assertEquals($recipient->getOrder(), $order);
    }

    //TODO it can have order history
}
