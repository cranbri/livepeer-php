<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Asset;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetAssetRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new GetAssetRequest instance
     */
    public function __construct(protected string $assetId)
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/asset/{$this->assetId}";
    }
}
