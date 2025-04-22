<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Playback;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetPlaybackInfoRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new GetPlaybackInfoRequest instance
     *
     * @param string $playbackId
     */
    public function __construct(protected string $playbackId)
    {}

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/playback/{$this->playbackId}";
    }
}
