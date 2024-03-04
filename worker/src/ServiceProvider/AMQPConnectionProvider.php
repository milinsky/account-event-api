<?php

declare(strict_types=1);

namespace App\ServiceProvider;

use AMQPConnection;
use App\Config\AMQPConfig;
use Duyler\DependencyInjection\Provider\AbstractProvider;

class AMQPConnectionProvider extends AbstractProvider
{
    public function __construct(private AMQPConfig $config) {}

    public function accept(object $definition): void
    {
        /** @var AMQPConnection $definition*/
        $definition->setHost($this->config->host);
        $definition->setPort($this->config->port);
        $definition->setLogin($this->config->login);
        $definition->setPassword($this->config->password);
        $definition->connect();
    }
}
