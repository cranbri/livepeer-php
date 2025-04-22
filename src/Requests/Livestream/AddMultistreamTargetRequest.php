<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Livestream;

use Cranbri\Livepeer\Data\AddMultistreamTargetData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AddMultistreamTargetRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Create a new CreateStreamRequest instance
     *
     * @param AddMultistreamTargetData $data
     */
    public function __construct(protected string $streamId, protected AddMultistreamTargetData $data)
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/stream/{$this->streamId}/create-multistream-target";
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
