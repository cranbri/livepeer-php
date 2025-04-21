<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\BaseData;

class LivestreamPullData extends BaseData
{
    /**
     * Create a new LivestreamPullData instance
     *
     * @param  string $source
     * @param ?array $headers
     * @param ?array $location
     */
    public function __construct(
        public string $source,
        public ?array $headers = null,
        public ?array $location = null,
    ) {
    }
}