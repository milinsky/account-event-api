<?php

declare(strict_types=1);

namespace App\Action;

use AMQPEnvelope;
use Duyler\Config\ConfigInterface;
use Duyler\EventBus\Dto\Result;
use Duyler\EventBus\Enum\ResultStatus;
use Fiber;
use parallel\Runtime;

class HandleAccountEventAction
{
    public function __construct(private ConfigInterface $config) {}

    public function __invoke(AMQPEnvelope $message): Result
    {
        $content = json_decode($message->getBody(), true);

        $future = Fiber::suspend(
            function () use ($content) {
                $runtime = new Runtime();
                return $runtime->run(
                    function () use ($content): string {
                        sleep(1);
                        return 'Account id: ' . $content['account_id'] . '. Event id: ' . $content['event_id'] . PHP_EOL;
                    }
                );
            }
        );

        echo $future->value();
        return new Result(
            status: ResultStatus::Success,
            data: $message,
        );
    }
}
