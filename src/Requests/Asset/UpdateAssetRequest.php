<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Asset;

use Cranbri\Livepeer\Data\Asset\UpdateAssetData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateAssetRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::PATCH;

    /**
     * Create a new GetAssetRequest instance
     */
    public function __construct(protected string $assetId, protected UpdateAssetData $data)
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

    /**
     * Define the request body
     *
     * @return array<mixed>
     */
    protected function defaultBody(): array
    {
        return $this->data->toArray();
    }
}
