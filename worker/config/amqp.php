<?php

declare(strict_types=1);

use App\Config\AccountEventQueueConfig;
use App\Config\AMQPConfig;
use Duyler\Config\FileConfig;

/**
 * @var FileConfig $config
 */
return [
    AMQPConfig::class => [
        'host' => 'rabbitmq',
        'port' => 5672,
        'login' => 'user',
        'password' => 'password',
    ],
    AccountEventQueueConfig::class => [
        'queueName' => 'account_events_queue',
        'threadsLimit' => 6,
    ],
];
