<?php

declare(strict_types=1);

namespace App\Action;

use App\Contract\AccountEventRequestModel;
use Psr\Http\Message\ServerRequestInterface;

class CreateRequestModelAction
{
    public function __invoke(ServerRequestInterface $request): AccountEventRequestModel
    {
        $body = json_decode($request->getBody()->getContents(), true);

        return new AccountEventRequestModel(
            $body['account_id'],
            $body['event_id'],
        );
    }
}
