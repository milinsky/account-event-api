<?php

declare(strict_types=1);

use GuzzleHttp\Client;

require 'vendor/autoload.php';

$client = new Client();

$i = 1;

while (true) {

    $response = $client->request(
        method: 'POST',
        uri: 'api/api/account-event',
        options: [
            'json' => [
                'account_id' => rand(1, 1000),
                'event_id' => $i,
            ]
        ]
    );

    $i = $i === 10000 ? 1 : ++$i;
    echo $response->getBody()->getContents() . PHP_EOL;
    usleep(1000 * 500);
}
