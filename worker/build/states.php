<?php

declare(strict_types=1);

use App\ServiceProvider\AMQPConnectionProvider;
use App\State\AckMessageStateHandler;
use App\State\ConnectToQueueStateHandler;
use App\State\ListeningQueueStateHandler;
use Duyler\Framework\Build\State\StateContext;
use Duyler\Framework\Build\State\StateHandler;

StateHandler::add(ListeningQueueStateHandler::class);
StateHandler::add(
    class: ConnectToQueueStateHandler::class,
    providers: [
        AMQPConnection::class => AMQPConnectionProvider::class,
    ],
);
StateHandler::add(AckMessageStateHandler::class);

StateContext::add([
    ListeningQueueStateHandler::class,
    ConnectToQueueStateHandler::class,
    AckMessageStateHandler::class,
]);
