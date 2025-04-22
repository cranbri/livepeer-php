<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Session;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetSessionRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new GetSessionRequest instance
     */
    public function __construct(protected string $sessionId)
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/session/{$this->sessionId}";
    }
}
