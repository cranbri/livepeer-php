<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Viewership;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class QueryCreatorViewershipMetricsRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new QueryCreatorViewershipMetricsRequest instance
     *
     * @param array<string,string> $filters
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
        return "/data/views/query/creator";
    }

    /**
     * Define the query parameters
     *
     * @return array<mixed>
     */
    protected function defaultQuery(): array
    {
        return $this->filters;
    }
}
