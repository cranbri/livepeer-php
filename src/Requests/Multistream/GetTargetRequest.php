<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Multistream;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetTargetRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new GetTargetRequest instance
     *
     * @param string $targetId
     */
    public function __construct(protected string $targetId)
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/multistream/target/{$this->targetId}";
    }
}
