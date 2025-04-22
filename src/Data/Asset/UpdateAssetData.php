<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\CreatorIdData;
use Cranbri\Livepeer\Data\PlaybackPolicyData;
use Cranbri\Livepeer\Data\StorageData;

class UpdateAssetData extends BaseData
{
    /**
     * Create a new UploadAssetData instance
     *
     * @param  ?string  $name  The name of the asset
     * @param  ?PlaybackPolicyData  $playbackPolicy  Whether the playback policy for an asset or stream is public or signed
     * @param  ?CreatorIdData  $creatorId  The ID of the creator of the asset
     * @param  ?StorageData  $storage  Custom storage configuration
     */
    public function __construct(
        public ?string $name = null,
        public ?PlaybackPolicyData $playbackPolicy = null,
        public ?CreatorIdData $creatorId = null,
        public ?StorageData $storage = null,
    ) {
    }
}
