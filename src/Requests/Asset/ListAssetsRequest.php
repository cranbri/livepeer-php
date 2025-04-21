<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Asset;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ListAssetsRequest extends Request
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
        return "/asset";
    }
}
