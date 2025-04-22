<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Session;

use Cranbri\Livepeer\Data\Asset\UrlUploadAssetData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ListRecordedSessionsRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new ListRecordedSessionsRequest instance
     */
    public function __construct(protected string $parentId)
    {}

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/stream/{$this->parentId}/sessions";
    }
}