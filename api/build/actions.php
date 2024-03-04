<?php

declare(strict_types=1);

use App\Action\CreateRequestModelAction;
use App\Contract\AccountEventRequestModel;
use Duyler\Framework\Build\Action\Action;
use Duyler\Web\Build\Attribute\Route;
use Duyler\Web\Build\Attribute\View;
use Duyler\Web\Enum\Method;
use Psr\Http\Message\ServerRequestInterface;

Action::build(id: 'CreateRequestModel', handler: CreateRequestModelAction::class)
    ->contract(AccountEventRequestModel::class)
    ->argument(ServerRequestInterface::class)
    ->externalAccess(true)
    ->require('Http.CreateRequest');

Action::build(id: 'Duyler.SayHello', handler: function () {})
    ->externalAccess(true)
    ->attributes(
        new Route(
            method: Method::Get,
            pattern: '/',
        ),
        new View(
            name: 'home',
        ),
    );
