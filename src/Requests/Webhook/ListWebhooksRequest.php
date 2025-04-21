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
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/webhook';
    }
}
