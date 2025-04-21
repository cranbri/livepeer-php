<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Webhook;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class QueryRealtimeViewershipRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new QueryRealtimeViewershipRequest instance
     *
     * @param array $filters
     */
    public function __construct(protected array $filters = [])
    {}

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/data/views/now";
    }

    /**
     * Define the query parameters
     *
     * @return array
     */
    protected function defaultQuery(): array
    {
        return $this->filters;
    }
}
