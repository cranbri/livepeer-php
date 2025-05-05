<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Transcode\Storage;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\Transcode\S3CredentialsData;
use Cranbri\Livepeer\Enums\TranscodeStorageType;

class S3StorageData extends BaseData
{
    /**
     * Create a new S3StorageData instance
     *
     * @param string $endpoint
     * @param string $bucket
     * @param TranscodeStorageType $type
     * @param S3CredentialsData $credentials
     */
    public function __construct(
        public string $endpoint,
        public string $bucket,
        public S3CredentialsData $credentials,
        public TranscodeStorageType $type = TranscodeStorageType::S3
    ) {
    }
}
