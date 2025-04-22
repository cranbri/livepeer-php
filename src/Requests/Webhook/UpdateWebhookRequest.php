<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Webhook;

use Cranbri\Livepeer\Data\Webhook\UpdateWebhookData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateWebhookRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::PUT;

    /**
     * Create a new GetWebhookRequest instance
     *
     * @param string $webhookId
     * @param UpdateWebhookData $data
     */
    public function __construct(protected string $webhookId, protected UpdateWebhookData $data)
    {
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/webhook/{$this->webhookId}";
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
