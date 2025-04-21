<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\Stream\StreamProfileData;

class UrlInputData extends BaseData
{
    /**
     * Create a new UrlInputData instance
     *
     * @param  string $url
    */
    public function __construct(
        public string $url,
    ) {
    }
}