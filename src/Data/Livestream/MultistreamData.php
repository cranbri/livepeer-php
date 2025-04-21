<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\Multistream\CreateTargetData;
use Cranbri\Livepeer\Data\Stream\StreamProfileData;

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