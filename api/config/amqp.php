<?php

declare(strict_types=1);

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
        'queueName' => 'account_events_queue',
    ],
];
