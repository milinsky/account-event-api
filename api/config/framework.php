<?php

declare(strict_types=1);

use Duyler\Config\FileConfig;
use Duyler\EventBus\BusConfig;
use Duyler\EventBus\Enum\Mode;
use Duyler\Framework\ApplicationLoader;

/**
 * @var FileConfig $config
 */
return [
    ApplicationLoader::class => [
        'packages' => [
            \Duyler\Http\Loader::class,
            \Duyler\Web\Loader::class
        ],
    ],
    BusConfig::class => [
        'mode' => Mode::Queue,
    ],
];
