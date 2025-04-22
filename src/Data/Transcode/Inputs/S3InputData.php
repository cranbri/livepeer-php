<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Transcode\Inputs;


use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\Transcode\S3CredentialsData;
use Cranbri\Livepeer\Enums\TranscodeInputType;

class S3InputData extends BaseData
{
    /**
     * Create a new S3InputData instance
     *
     * @param string $endpoint
     * @param string $bucket
     * @param string $path
     * @param TranscodeInputType $type
     * @param S3CredentialsData $credentials
    */
    public function __construct(
        public string $endpoint,
        public string $bucket,
        public string $path,
        public S3CredentialsData $credentials,
        public TranscodeInputType $type = TranscodeInputType::S3
    ) {
    }
}