<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Transcode;

use Cranbri\Livepeer\Data\BaseData;

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
