<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Livestream;

use Cranbri\Livepeer\Data\BaseData;

class CreateMultistreamTargetData extends BaseData
{
    /**
     * Create a new CreateMultistreamTargetData instance
     *
     * @param  string  $url
     * @param ?string $name
     */
    public function __construct(
        public string $url,
        public ?string $name,
    ) {
    }
}
