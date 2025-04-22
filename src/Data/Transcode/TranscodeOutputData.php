<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Transcode;

use Cranbri\Livepeer\Data\BaseData;

class TranscodeOutputData extends BaseData
{
    /**
     * Create a new TranscodeOutputData instance
     *
     * @param  array $hls Must contain array key 'path'
     * @param  array $mpf Must contain array key 'path'
     * @param  array $fmp4 Must contain array key 'path'
    */
    public function __construct(
        public array $hls,
        public array $mp4,
        public array $fmp4,
    ) {
    }
}