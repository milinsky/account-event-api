<?php

declare(strict_types=1);

namespace App\Config;

readonly class AMQPConfig
{
    public function __construct(
        public string $host,
        public int $port,
        public string $login,
        public string $password,
        public string $queueName,
    ) {}
}
