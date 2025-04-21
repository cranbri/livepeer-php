<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\BaseData;
use Cranbri\Livepeer\Data\Multistream\CreateTargetData;

class AddMultistreamTargetData extends BaseData
{
    /**
     * Create a new AddMultistreamTargetData instance
     *
     * @param  string $source  Name of transcoding profile that should be sent. Use "source" for pushing source stream data
     * @param  bool $videoOnly  If true, the stream audio will be muted and only silent video will be pushed to the target.
     * @param  ?string $id ID of multistream target object where to push this stream
     * @param  ?CreateTargetData $spec  Inline multistream target object. Will automatically create the target resource to be used by the created stream.
     */
    public function __construct(
        public string $source,
        public bool $videoOnly = false,
        public ?string $id = null,
        public ?CreateTargetData $spec = null
    ) {
    }
}