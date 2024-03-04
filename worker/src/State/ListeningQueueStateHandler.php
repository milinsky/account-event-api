<?php

declare(strict_types=1);

namespace App\State;

use AMQPEnvelope;
use AMQPQueue;
use App\Action\HandleAccountEventAction;
use App\Config\AccountEventQueueConfig;
use Duyler\EventBus\Contract\State\MainCyclicStateHandlerInterface;
use Duyler\EventBus\Dto\Action;
use Duyler\EventBus\Dto\Trigger;
use Duyler\EventBus\Enum\ResultStatus;
use Duyler\EventBus\State\Service\StateMainCyclicService;
use Duyler\EventBus\State\StateContext;
use Override;

class ListeningQueueStateHandler implements MainCyclicStateHandlerInterface
{
    private int $resetCount = 0;

    public function __construct(private AccountEventQueueConfig $queueConfig) {}

    #[Override]
    public function handle(StateMainCyclicService $stateService, StateContext $context): void
    {
        /** @var AMQPQueue $queue */
        $queue = $context->read('queue');

        if ($stateService->queueCount() === $this->queueConfig->threadsLimit) {
            $this->resetCount = $this->queueConfig->threadsLimit - 1;
            return;
        }

        if ($this->resetCount > 0) {
            $this->resetCount--;
            return;
        }

        $message = $queue->get();
        if ($message === null) {
            return;
        }

        $content = json_decode($message->getBody(), true);

        $actionId = 'account_id_' . $content['account_id'];

        if ($stateService->actionIsExists($actionId) === false) {
            $stateService->addAction(
                new Action(
                    id: $actionId,
                    handler: HandleAccountEventAction::class,
                    triggeredOn: $actionId,
                    argument: AMQPEnvelope::class,
                    contract: AMQPEnvelope::class,
                    repeatable: true,
                    lock: true,
                )
            );
        }

        $stateService->doTrigger(
            new Trigger(
                id: $actionId,
                status: ResultStatus::Success,
                data: $message,
                contract: AMQPEnvelope::class,
            )
        );
    }
}
