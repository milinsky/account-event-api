<?php

declare(strict_types=1);

use App\Config\OpenApiConfig;
use Duyler\Config\FileConfig;

/**
 * @var FileConfig $config
 */
return [
    OpenApiConfig::class => [
        'pathToOpenApiSpec' => $config->env('PROJECT_ROOT') . 'data/openapi.yaml',
    ],
];
