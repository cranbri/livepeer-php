<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Asset;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteAssetRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::DELETE;

    /**
     * Create a new DeleteAssetRequest instance
     *
     * @param string $assetId
     */
    public function __construct(protected string $assetId)
    {}

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
