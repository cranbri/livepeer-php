<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\AccessControl;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetSigningKeyRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new GetSigningKeyRequest instance
     *
     * @param string $keyId
     */
    public function __construct(protected string $keyId)
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/access-control/signing-key/{$this->keyId}";
    }
}
