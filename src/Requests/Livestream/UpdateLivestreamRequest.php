<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Livestream;

use Cranbri\Livepeer\Data\Livestream\UpdateLivestreamData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateLivestreamRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::PATCH;

    /**
     * Create a new GetStreamRequest instance
     *
     * @param string $streamId
     * @param UpdateLivestreamData $data
     */
    public function __construct(protected string $streamId, protected UpdateLivestreamData $data)
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/stream/{$this->streamId}";
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
