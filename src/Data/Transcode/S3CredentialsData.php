<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\Stream\StreamProfileData;

class S3CredentialsData extends BaseData
{
    /**
     * Create a new S3CredentialsData instance
     *
     * @param  string $accessKeyId
     * @param  string $secretAccessKey
    */
    public function __construct(
        public string $accessKeyId,
        public string $secretAccessKey,
    ) {
    }
}