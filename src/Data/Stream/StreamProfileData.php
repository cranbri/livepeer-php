<?php

declare(strict_types=1);


namespace Cranbri\Livepeer\Data\Stream;

use Cranbri\Livepeer\Data\BaseData;

class StreamProfileData extends BaseData
{
    /**
     * Create a new StreamProfileData instance
     *
     * @param  string  $name  The name of the profile
     * @param  int  $width  The width of the profile
     * @param  int  $height  The height of the profile
     * @param  int|null  $fps  The framerate of the profile
     * @param  int|null  $bitrate  The bitrate of the profile
     * @param  string|null  $encoderPreset  The encoder preset of the profile
     */
    public function __construct(
        public string $name,
        public int $width,
        public int $height,
        public ?int $fps = null,
        public ?int $bitrate = null,
        public ?string $encoderPreset = null
    ) {
    }

    /**
     * Static method to create a 720p profile
     *
     * @param  string  $name
     * @param  int  $fps
     * @param  int  $bitrate
     * @return static
     */
    public static function hd720(
        string $name = '720p',
        int $fps = 30,
        int $bitrate = 3000000
    ): self {
        return new self(
            name: $name,
            width: 1280,
            height: 720,
            fps: $fps,
            bitrate: $bitrate
        );
    }

    /**
     * Static method to create a 1080p profile
     *
     * @param  string  $name
     * @param  int  $fps
     * @param  int  $bitrate
     * @return static
     */
    public static function hd1080(
        string $name = '1080p',
        int $fps = 30,
        int $bitrate = 6000000
    ): self {
        return new self(
            name: $name,
            width: 1920,
            height: 1080,
            fps: $fps,
            bitrate: $bitrate
        );
    }

    /**
     * Static method to create a 480p profile
     *
     * @param  string  $name
     * @param  int  $fps
     * @param  int  $bitrate
     * @return static
     */
    public static function sd480(
        string $name = '480p',
        int $fps = 30,
        int $bitrate = 1000000
    ): self {
        return new self(
            name: $name,
            width: 854,
            height: 480,
            fps: $fps,
            bitrate: $bitrate
        );
    }

    /**
     * Static method to create a 4K profile
     *
     * @param string $name
     * @param int $fps
     * @param int $bitrate
     * @return static
     */
    public static function uhd4k(
        string $name = '4K',
        int $fps = 30,
        int $bitrate = 20000000
    ): self {
        return new self(
            name: $name,
            width: 3840,
            height: 2160,
            fps: $fps,
            bitrate: $bitrate
        );
    }

    /**
     * Static method to create a 4K profile at 60fps
     *
     * @param string $name
     * @param int $bitrate
     * @return static
     */
    public static function uhd4k60(
        string $name = '4K60',
        int $bitrate = 35000000
    ): self {
        return new self(
            name: $name,
            width: 3840,
            height: 2160,
            fps: 60,
            bitrate: $bitrate
        );
    }
}