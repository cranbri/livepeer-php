<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data;

use Cranbri\Livepeer\Enums\EncoderType;
use Cranbri\Livepeer\Enums\StreamProfiles;

class StreamProfileData extends BaseData
{
    /**
     * Create a new StreamProfileData instance
     *
     * @param  int  $bitrate  The bitrate of the profile
     * @param  ?string  $name  The name of the profile
     * @param  ?int  $width  The width of the profile
     * @param  ?int  $height  The height of the profile
     * @param  ?int  $fps  The framerate of the profile
     * @param  ?int  $fpsDen
     * @param  ?string  $gop
     * @param  ?string  $encoderPreset  The encoder preset of the profile
     * @param  ?int $quality Restricts the size of the output video using the constant quality feature. Increasing this value will result in a lower quality video. Note that this parameter might not work if the transcoder lacks support for it.
     * @param  ?StreamProfiles $profile,
     * @param  ?EncoderType $encoder
     */
    public function __construct(
        public int $bitrate,
        public ?string $name = null,
        public ?int $width = null,
        public ?int $height = null,
        public ?int $fps = null,
        public ?int $fpsDen = null,
        public ?string $gop = null,
        public ?string $encoderPreset = null,
        public ?int $quality = null,
        public ?StreamProfiles $profile = null,
        public ?EncoderType $encoder = null,
    ) {
    }

    /**
     * Static method to create a 720p profile
     *
     * @param  string  $name
     * @param  int  $fps
     * @param  int  $bitrate
     * @return StreamProfileData
     */
    public static function hd720(
        string $name = '720p',
        int $fps = 30,
        int $bitrate = 3000000
    ): self {
        return new self(
            bitrate: $bitrate,
            name: $name,
            width: 1280,
            height: 720,
            fps: $fps
        );
    }

    /**
     * Static method to create a 1080p profile
     *
     * @param  string  $name
     * @param  int  $fps
     * @param  int  $bitrate
     * @return StreamProfileData
     */
    public static function hd1080(
        string $name = '1080p',
        int $fps = 30,
        int $bitrate = 6000000
    ): self {
        return new self(
            bitrate: $bitrate,
            name: $name,
            width: 1920,
            height: 1080,
            fps: $fps
        );
    }

    /**
     * Static method to create a 480p profile
     *
     * @param  string  $name
     * @param  int  $fps
     * @param  int  $bitrate
     * @return StreamProfileData
     */
    public static function sd480(
        string $name = '480p',
        int $fps = 30,
        int $bitrate = 1000000
    ): self {
        return new self(
            bitrate: $bitrate,
            name: $name,
            width: 854,
            height: 480,
            fps: $fps
        );
    }

    /**
     * Static method to create a 4K profile
     *
     * @param string $name
     * @param int $fps
     * @param int $bitrate
     * @return StreamProfileData
     */
    public static function uhd4k(
        string $name = '4K',
        int $fps = 30,
        int $bitrate = 20000000
    ): self {
        return new self(
            bitrate: $bitrate,
            name: $name,
            width: 3840,
            height: 2160,
            fps: $fps
        );
    }
}
