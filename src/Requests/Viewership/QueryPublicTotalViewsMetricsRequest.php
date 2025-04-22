<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Viewership;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class QueryPublicTotalViewsMetricsRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new QueryPublicTotalViewsMetricsRequest instance
     *
     * @param string $playbackId
     */
    public function __construct(protected string $playbackId)
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/data/views/query/total/{$this->playbackId}";
    }
}
