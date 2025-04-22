<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Livestream;

use Cranbri\Livepeer\Data\BaseData;

class LivestreamPullData extends BaseData
{
    /**
     * Create a new LivestreamPullData instance
     *
     * @param  string $source
     * @param ?array<string, string> $headers
     * @param ?array<string, float> $location
     */
    public function __construct(
        public string $source,
        public ?array $headers = null,
        public ?array $location = null,
    ) {
    }
}
