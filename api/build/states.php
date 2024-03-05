<?php

declare(strict_types=1);

use App\State\RequestValidationStateHandler;
use Duyler\Framework\Build\State\StateHandler;

StateHandler::add(RequestValidationStateHandler::class);
