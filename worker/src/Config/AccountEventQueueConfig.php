<?php

declare(strict_types=1);

namespace App\Config;

readonly class AccountEventQueueConfig
{
    public function __construct(
        public string $queueName,
        public int $threadsLimit,
    ) {}
}
