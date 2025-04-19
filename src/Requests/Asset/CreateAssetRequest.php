<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Asset;

use Cranbri\Livepeer\Data\Asset\CreateAssetData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateAssetRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * The asset data
     *
     * @var CreateAssetData
     */
    protected CreateAssetData $data;

    /**
     * Create a new CreateAssetRequest instance
     *
     * @param CreateAssetData $data
     */
    public function __construct(CreateAssetData $data)
    {
        $this->data = $data;
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/asset';
    }

    /**
     * Define the request body
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return $this->data->toArray();
    }
}