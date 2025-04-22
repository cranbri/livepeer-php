<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\LiveStream;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\Multistream\CreateTargetData;

class MultistreamData extends BaseData
{
    /**
     * Create a new MultistreamData instance
     *
     * @param  CreateTargetData[] $targets
     */
    public function __construct(
        public array $targets,
    ) {
    }
}
