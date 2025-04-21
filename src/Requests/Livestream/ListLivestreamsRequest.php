<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Stream;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ListLivestreamsRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new ListStreamsRequest instance
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
        return '/stream';
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
