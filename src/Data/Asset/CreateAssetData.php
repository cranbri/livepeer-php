<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\BaseData;

class CreateAssetData extends BaseData
{
    /**
     * Create a new CreateAssetData instance
     *
     * @param  string|null  $name  The name of the asset
     * @param  string|null  $url  The URL to the video file
     * @param  bool|null  $encrypt  Whether to encrypt the asset
     * @param  array|null  $playbackPolicy  A list of playback policies
     */
    public function __construct(
        public ?string $name = null,
        public ?string $url = null,
        public ?bool $encrypt = null,
        public ?array $playbackPolicy = null
    ) {
    }
}