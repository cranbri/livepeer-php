<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Livestream;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteLivestreamRequest extends Request
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
     */
    public function __construct(protected string $streamId)
    {}

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/stream/{$this->streamId}";
    }
}
