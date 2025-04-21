<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\Stream\StreamProfileData;

class CreateTranscodingData extends BaseData
{
    /**
     * Create a new CreateTranscodingData instance
     *
     * @param  S3InputData|UrlInputData $input
     * @param  S3StorageData|Web3StorageData $storage
     * @param  TranscodeOutputData $outputs
     * @param  ?StreamProfileData[]  $profiles
     * @param ?int  $targetSegmentSizeSecs
     * @param  ?CreatorIdData  $creatorId  The ID of the creator of the asset
     * @param  bool  $c2pa  Decides if the output video should include C2PA signature
    */
    public function __construct(
        public S3InputData|UrlInputData $input,
        public S3StorageData|Web3StorageData $storage,
        public TranscodeOutputData $outputs,
        public ?array $profiles = null,
        public ?int $targetSegmentSizeSecs = null,
        public ?CreatorIdData $creatorId = null,
        public bool $c2pa = false
    ) {
    }
}