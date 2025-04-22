<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Transcode;

use Cranbri\Livepeer\Data\Transcode\CreateTranscodingData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class TranscodeVideoRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Create a new TranscodeVideoRequest instance
     *
     * @param CreateTranscodingData $data
     */
    public function __construct(protected CreateTranscodingData $data)
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/transcode";
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
