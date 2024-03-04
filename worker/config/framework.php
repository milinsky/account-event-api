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
            // Add your packages here
        ],
    ],
    BusConfig::class => [
        'allowCircularCall' => true,
        'autoreset' => true,
        'mode' => Mode::Loop,
    ],
];
