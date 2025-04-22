<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Transcode\Inputs;

use Cranbri\Livepeer\Data\BaseData;

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