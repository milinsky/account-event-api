<?php

declare(strict_types=1);

use App\Contract\AccountEventRequestModel;
use App\Controller\HandleAccountEventController;
use App\ServiceProvider\AMQPConnectionProvider;
use Duyler\Web\Build\Attribute\Route;
use Duyler\Web\Build\Controller;
use Duyler\Web\Enum\Method;

Controller::build(HandleAccountEventController::class)
    ->contracts([AccountEventRequestModel::class])
    ->providers([
        AMQPConnection::class => AMQPConnectionProvider::class
    ])
    ->attributes(
        new Route(
            method: Method::Post,
            pattern: 'api/account-event',
        ),
    );
