<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Livestream;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class RemoveMultistreamTargetRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::DELETE;

    /**
     * Create a new DeleteStreamRequest instance
     *
     * @param string $streamId
     * @param string $targetId
     */
    public function __construct(protected string $streamId, protected string $targetId)
    {}

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/stream/{$this->streamId}/multistream/{$this->targetId}";
    }
}
