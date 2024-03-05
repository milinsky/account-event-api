<?php

declare(strict_types=1);

namespace App\State;

use AMQPChannel;
use AMQPConnection;
use AMQPQueue;
use App\Config\AccountEventQueueConfig;
use Duyler\EventBus\Contract\State\MainBeginStateHandlerInterface;
use Duyler\EventBus\State\Service\StateMainBeginService;
use Duyler\EventBus\State\StateContext;
use Override;

class ConnectToQueueStateHandler implements MainBeginStateHandlerInterface
{
    public function __construct(
        private AMQPConnection $connection,
        private AccountEventQueueConfig $queueConfig,
    ) {}

    #[Override]
    public function handle(StateMainBeginService $stateService, StateContext $context): void
    {
        $channel = new AMQPChannel($this->connection);

        $queue = new AMQPQueue($channel);
        $queue->setName($this->queueConfig->queueName);
        $queue->declareQueue();

        $context->write('queue', $queue);
    }
}
