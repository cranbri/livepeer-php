<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Livestream;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\CreatorIdData;
use Cranbri\Livepeer\Data\PlaybackPolicyData;
use Cranbri\Livepeer\Data\StreamProfileData;

class CreateLivestreamData extends BaseData
{
    /**
     * Create a new CreateLivestreamData instance
     *
     * @param  string  $name
     * @param  ?LivestreamPullData  $pull
     * @param  ?PlaybackPolicyData  $playbackPolicy  Whether the playback policy for an asset or stream is public or signed
     * @param  ?CreatorIdData  $creatorId  The ID of the creator of the asset
     * @param  ?StreamProfileData[]  $profiles
     * @param ?bool $record
     * @param ?RecordingSpecData $recordingSpec
     * @param ?MultistreamData $multistream
     */
    public function __construct(
        public string $name,
        public ?LivestreamPullData $pull = null,
        public ?PlaybackPolicyData $playbackPolicy = null,
        public ?CreatorIdData $creatorId = null,
        public ?array $profiles = null,
        public ?bool $record = null,
        public ?RecordingSpecData $recordingSpec = null,
        public ?MultistreamData $multistream = null
    ) {
    }
}
