<?php

declare(strict_types=1);

namespace App\Config;

readonly class OpenApiConfig
{
    public function __construct(public string $pathToOpenApiSpec) {}
}
