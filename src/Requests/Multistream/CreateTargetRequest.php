<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Multistream;

use Cranbri\Livepeer\Data\Multistream\CreateTargetData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateTargetRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Create a new CreateTargetRequest instance
     *
     * @param CreateTargetData $data
     */
    public function __construct(protected CreateTargetData $data)
    {}

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/multistream/target";
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
