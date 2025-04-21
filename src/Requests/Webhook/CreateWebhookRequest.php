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
     * The webhook data
     *
     * @var CreateWebhookData
     */
    protected CreateWebhookData $data;

    /**
     * Create a new CreateWebhookRequest instance
     *
     * @param CreateWebhookData $data
     */
    public function __construct(CreateWebhookData $data)
    {
        $this->data = $data;
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
     * @return array
     */
    protected function defaultBody(): array
    {
        return $this->data->toArray();
    }
}
