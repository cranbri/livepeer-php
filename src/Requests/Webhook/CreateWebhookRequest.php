<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Webhook;

use Cranbri\Livepeer\Data\Webhook\CreateWebhookData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateWebhookRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Create a new CreateWebhookRequest instance
     *
     * @param CreateWebhookData $data
     */
    public function __construct(protected CreateWebhookData $data)
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/webhook';
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
