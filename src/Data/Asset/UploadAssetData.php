<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\CreatorIdData;
use Cranbri\Livepeer\Data\EncryptionData;
use Cranbri\Livepeer\Data\PlaybackPolicyData;
use Cranbri\Livepeer\Data\StorageData;
use Cranbri\Livepeer\Data\StreamProfileData;
use Cranbri\Livepeer\Data\BaseData;

class UploadAssetData extends BaseData
{
    /**
     * Create a new UploadAssetData instance
     *
     * @param  string  $name  The name of the asset
     * @param  ?bool  $staticMp4  Whether to create a static MP4 version of the asset
     * @param  ?PlaybackPolicyData  $playbackPolicy  Whether the playback policy for an asset or stream is public or signed
     * @param  ?CreatorIdData  $creatorId  The ID of the creator of the asset
     * @param  ?StorageData  $storage  Custom storage configuration
     * @param  ?EncryptionData  $encryption  Asset encryption key
     * @param  bool  $c2pa  Decides if the output video should include C2PA signature
     * @param ?StreamProfileData[]  $profiles
     * @param ?int  $targetSegmentSizeSecs
     */
    public function __construct(
        public string $name,
        public ?bool $staticMp4 = null,
        public ?PlaybackPolicyData $playbackPolicy = null,
        public ?CreatorIdData $creatorId = null,
        public ?StorageData $storage = null,
        public ?EncryptionData $encryption = null,
        public bool $c2pa = false,
        public ?array $profiles = null,
        public ?int $targetSegmentSizeSecs = null
    ) {
    }
}