<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Multistream;

use Cranbri\Livepeer\Data\Multistream\UpdateTargetData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateTargetRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::PATCH;

    /**
     * Create a new UpdateTargetRequest instance
     *
     * @param UpdateTargetData $data
     */
    public function __construct(protected string $targetId, protected UpdateTargetData $data)
    {}

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/multistream/target/{$this->targetId}";
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
