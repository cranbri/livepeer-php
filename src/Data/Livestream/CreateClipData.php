<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Livestream;

use Cranbri\Livepeer\Data\BaseData;

class CreateClipData extends BaseData
{
    /**
     * Create a new StorageData instance
     *
     * @param  string $playbackId The playback ID of the stream or stream recording to clip. Asset playback IDs are not supported yet.
     * @param  int $startTime The start timestamp of the clip in Unix milliseconds. See the ClipTrigger in the UI Kit for an example of how this is calculated (for HLS, it uses Program Date-Time tags, and for WebRTC, it uses the latency from server to client at stream startup).
     * @param ?int $endTime The end timestamp of the clip in Unix milliseconds. See the ClipTrigger in the UI Kit for an example of how this is calculated (for HLS, it uses Program Date-Time tags, and for WebRTC, it uses the latency from server to client at stream startup).
     * @param ?string $name  The optional friendly name of the clip to create.
     * @param ?string $sessionId The optional session ID of the stream to clip. This can be used to clip recordings - if it is not specified, it will clip the ongoing livestream.
     */
    public function __construct(
        public string $playbackId,
        public int $startTime,
        public ?int $endTime = null,
        public ?string $name = null,
        public ?string $sessionId = null
    ) {
    }
}
