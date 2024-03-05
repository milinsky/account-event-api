<?php

declare(strict_types=1);

namespace App\State;

use App\Config\OpenApiConfig;
use Duyler\EventBus\Contract\State\MainAfterStateHandlerInterface;
use Duyler\EventBus\State\Service\StateMainAfterService;
use Duyler\EventBus\State\StateContext;
use League\OpenAPIValidation\PSR7\ValidatorBuilder;
use Override;
use Psr\Http\Message\ServerRequestInterface;

class RequestValidationStateHandler implements MainAfterStateHandlerInterface
{
    public function __construct(
        private ValidatorBuilder $validatorBuilder,
        private OpenApiConfig $openApiConfig,
    ) {}

    #[Override]
    public function handle(StateMainAfterService $stateService, StateContext $context): void
    {
        $validator = $this->validatorBuilder
            ->fromYamlFile($this->openApiConfig->pathToOpenApiSpec)
            ->getServerRequestValidator();

        /** @var ServerRequestInterface $request */
        $request = $stateService->getResultData();

        $body = clone $request->getBody();

        $validator->validate($request->withBody($body));
    }

    #[Override]
    public function observed(StateContext $context): array
    {
        return ['Http.CreateRequest'];
    }
}
