<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\Stream\StreamProfileData;
use Cranbri\Livepeer\Enums\TranscodeInputType;
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