<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Webhook;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ListWebhooksRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * The filters to apply
     *
     * @var array
     */
    protected array $filters;

    /**
     * Create a new ListWebhooksRequest instance
     *
     * @param array $filters
     */
    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/webhook';
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
