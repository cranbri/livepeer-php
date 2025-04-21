<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Webhook;

use Cranbri\Livepeer\Data\DataObject;

class CreateWebhookData extends DataObject
{
    /**
     * The name of the webhook
     *
     * @var string
     */
    protected string $name;

    /**
     * The URL of the webhook
     *
     * @var string
     */
    protected string $url;

    /**
     * The events to listen for
     *
     * @var array
     */
    protected array $events;

    /**
     * Create a new CreateWebhookData instance
     *
     * @param string $name
     * @param string $url
     * @param array $events
     */
    public function __construct(
        string $name,
        string $url,
        array $events
    ) {
        $this->name = $name;
        $this->url = $url;
        $this->events = $events;
    }

    /**
     * Get the name of the webhook
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the URL of the webhook
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Get the events to listen for
     *
     * @return array
     */
    public function getEvents(): array
    {
        return $this->events;
    }
}
