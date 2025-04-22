<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Viewership;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class QueryViewershipMetricsRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new QueryViewershipMetricsRequest instance
     *
     * @param array $filters
     */
    public function __construct(protected array $filters = [])
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/data/views/query";
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
