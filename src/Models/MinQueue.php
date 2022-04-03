<?php
declare(strict_types=1);

namespace App\Models;

use SplPriorityQueue;
use SplObjectStorage;

class MinQueue implements \Countable
{
    /**
     * @var SplPriorityQueue
     */
    private $queue;

    /**
     * @var SplObjectStorage
     */
    private SplObjectStorage $register;

    /**
     * MinQueue constructor.
     */
    public function __construct()
    {
        $this->queue = new class extends SplPriorityQueue
        {
            /** @inheritdoc */
            //TODO FIX THIS ATTRIBUTE USE
            #[\ReturnTypeWillChange]
            public function compare($priority1, $priority2): int
            {
                return $priority2 <=> $priority1;
            }
        };

        $this->register = new \SplObjectStorage();
    }

    /**
     * @param object $value
     * @param mixed  $priority
     */
    public function insert(object $value, mixed $priority)
    {
        $this->queue->insert($value, $priority);
        $this->register->attach($value);
    }

    /**
     * @return object
     */
    public function extract(): object
    {
        $value = $this->queue->extract();
        $this->register->detach($value);

        return $value;
    }

    public function contains($value): bool
    {
        return $this->register->contains($value);
    }

    /**
     * @inheritdoc
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        return count($this->queue);
    }
}
