<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data;

use Cranbri\Livepeer\Enums\PlaybackPolicyType;

class PlaybackPolicyData extends BaseData
{
    /**
     * Create a new PlaybackPolicyData instance
     *
     * @param  PlaybackPolicyType  $type  The type of playback policy (public, jwt, webhook)
     * @param ?string  $webhookId  The ID of the webhook to use (required if type is webhook)
     * @param ?array<string,string>  $webhookContext  Additional context to send to the webhook
     * @param ?int  $refreshInterval  Interval (in seconds) at which the playback policy should be refreshed (default 600 seconds)
     * @param ?array<string>  $allowedOrigins  List of allowed origins for CORS playback (<scheme>://<hostname>:<port>, <scheme>://<hostname>)
     */
    public function __construct(
        public PlaybackPolicyType $type = PlaybackPolicyType::PUBLIC,
        public ?string $webhookId = null,
        public ?array $webhookContext = null,
        public ?int $refreshInterval = null,
        public ?array $allowedOrigins = null
    ) {
    }

    /**
     * Create a public playback policy
     *
     * @return PlaybackPolicyData
     */
    public static function public(): self
    {
        return new self(type: PlaybackPolicyType::PUBLIC);
    }

    /**
     * Create a JWT playback policy
     *
     * @return PlaybackPolicyData
     */
    public static function jwt(): self
    {
        return new self(type: PlaybackPolicyType::JWT);
    }

    /**
     * Create a webhook playback policy
     *
     * @param  string  $webhookId  The ID of the webhook to use
     * @param  array<string,string>|null  $webhookContext  Additional context to send to the webhook
     * @return PlaybackPolicyData
     */
    public static function webhook(string $webhookId, ?array $webhookContext = null): self
    {
        return new self(
            type: PlaybackPolicyType::WEBHOOK,
            webhookId: $webhookId,
            webhookContext: $webhookContext
        );
    }
}
