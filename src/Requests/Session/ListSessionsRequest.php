<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Asset;

use Cranbri\Livepeer\Data\Asset\UrlUploadAssetData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ListSessionsRequest extends Request
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
        return "/session";
    }
}