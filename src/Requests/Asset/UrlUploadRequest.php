<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Asset;

use Cranbri\Livepeer\Data\Asset\UrlUploadAssetData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UrlUploadRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Create a new CreateAssetRequest instance
     *
     * @param UrlUploadAssetData $data
     */
    public function __construct(protected UrlUploadAssetData $data)
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/asset/upload/url';
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
