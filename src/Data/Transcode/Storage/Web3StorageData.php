<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Transcode\Storage;


use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\Transcode\Web3CredentialsData;
use Cranbri\Livepeer\Enums\TranscodeStorageType;

class Web3StorageData extends BaseData
{
    /**
     * Create a new Web3StorageData instance
     *
     * @param TranscodeStorageType $type
     * @param Web3CredentialsData $credentials
     */
    public function __construct(
        public Web3CredentialsData $credentials,
        public TranscodeStorageType $type = TranscodeStorageType::WEB3_STORAGE
    ) {
    }
}