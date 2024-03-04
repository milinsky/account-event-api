<?php

declare(strict_types=1);

namespace App\Contract;

readonly class AccountEventRequestModel
{
    public function __construct(
        public int $accountId,
        public int $eventId,
    ) {}
}
