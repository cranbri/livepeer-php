<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Webhook;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteWebhookRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::DELETE;

    /**
     * The webhook ID
     *
     * @var string
     */
    protected string $webhookId;

    /**
     * Create a new DeleteWebhookRequest instance
     *
     * @param string $webhookId
     */
    public function __construct(string $webhookId)
    {
        $this->webhookId = $webhookId;
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
}
