<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Webhook;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Enums\WebhookEvent;

class UpdateWebhookData extends BaseData
{
    /**
     * Create a new UpdateWebhookData instance
     *
     * @param string $name
     * @param string $url
     * @param WebhookEvent[] $events
     * @param ?string  $projectId
     * @param ?string  $sharedSecret
     * @param ?string  $streamId
     */
    public function __construct(
        public string $name,
        public string $url,
        public array $events,
        public ?string $projectId = null,
        public ?string $sharedSecret = null,
        public ?string $streamId = null,
    ) {
    }
}
