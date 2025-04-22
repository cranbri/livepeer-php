<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Livestream;


use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\StreamProfileData;

class RecordingSpecData extends BaseData
{
    /**
     * Create a new RecordingSpecData instance
     *
     * @param  StreamProfileData[] $profiles
     */
    public function __construct(
        public array $profiles,
    ) {
    }
}