<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data;

use Cranbri\Livepeer\Data\Livestream\CreateMultistreamTargetData;

class AddMultistreamTargetData extends BaseData
{
    /**
     * Create a new AddMultistreamTargetData instance
     *
     * @param  string $profile  Name of transcoding profile that should be sent. Use "source" for pushing source stream data
     * @param  bool $videoOnly  If true, the stream audio will be muted and only silent video will be pushed to the target.
     * @param  ?string $id ID of multistream target object where to push this stream
     * @param  ?CreateMultistreamTargetData $spec  Inline multistream target object. Will automatically create the target resource to be used by the created stream.
     */
    public function __construct(
        public string $profile,
        public bool $videoOnly = false,
        public ?string $id = null,
        public ?CreateMultistreamTargetData $spec = null
    ) {
    }
}
