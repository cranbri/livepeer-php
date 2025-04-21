<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Multistream;

use Cranbri\Livepeer\Data\BaseData;

class UpdateTargetData extends BaseData
{
    /**
     * Create a new UpdateTargetData instance
     *
     * @param  string  $url
     * @param ?string $name
     * @param ?bool $disabled
     */
    public function __construct(
        public string $url,
        public ?string $name,
        public ?bool $disabled = false
    ) {
    }
}
