<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\AccessControl;

use Cranbri\Livepeer\Data\AccessControl\UpdateSigningKeyData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateSigningKeyRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::PATCH;

    /**
     * Create a new UpdateSigningKeyRequest instance
     *
     * @param string $keyId
     * @param UpdateSigningKeyData $data
     */
    public function __construct(protected string $keyId, protected UpdateSigningKeyData $data)
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
