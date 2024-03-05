<?php

declare(strict_types=1);

namespace App\State;

use AMQPEnvelope;
use AMQPQueue;
use Duyler\EventBus\Contract\State\MainAfterStateHandlerInterface;
use Duyler\EventBus\Enum\ResultStatus;
use Duyler\EventBus\State\Service\StateMainAfterService;
use Duyler\EventBus\State\StateContext;
use Override;

class AckMessageStateHandler implements MainAfterStateHandlerInterface
{
    #[Override]
    public function handle(StateMainAfterService $stateService, StateContext $context): void
    {
        if ($stateService->getStatus() === ResultStatus::Success) {
            /** @var AMQPEnvelope $message */
            $message = $stateService->getResultData();
            /** @var AMQPQueue $queue */
            $queue = $context->read('queue');
            $queue->ack($message->getDeliveryTag());
        }
    }

    #[Override]
    public function observed(StateContext $context): array
    {
        return [];
    }
}
