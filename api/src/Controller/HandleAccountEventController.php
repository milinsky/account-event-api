<?php

declare(strict_types=1);

namespace App\Controller;

use AMQPChannel;
use AMQPConnection;
use AMQPExchange;
use App\Config\AMQPConfig;
use App\Contract\AccountEventRequestModel;
use Duyler\Web\AbstractController;
use Exception;
use Psr\Http\Message\ResponseInterface;

class HandleAccountEventController extends AbstractController
{
    public function __construct(
        private AMQPConnection $connection,
        private AMQPConfig $amqpConfig
    ) {}

    public function __invoke(AccountEventRequestModel $requestModel): ResponseInterface
    {
        $channel = new AMQPChannel($this->connection);

        $exchange = new AMQPExchange($channel);

        try {
            $message = json_encode([
                'account_id' => $requestModel->accountId,
                'event_id' => $requestModel->eventId,
            ]);

            $exchange->publish($message, $this->amqpConfig->queueName);
            return $this->json([
                'status' => true,
                'message' => 'Событие успешно принято в обработку',
            ]);
        } catch (Exception $e) {
            $this->connection->disconnect();
            return $this->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
