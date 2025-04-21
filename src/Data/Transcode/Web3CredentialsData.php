<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\Stream\StreamProfileData;

class Web3CredentialsData extends BaseData
{
    /**
     * Create a new Web3CredentialsData instance
     *
     * @param  string $proof
    */
    public function __construct(
        public string $proof,
    ) {
    }
}