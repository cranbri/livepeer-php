<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Enums;

enum EncoderType: string
{
    case H264 = 'H.264';
    case HEVC = 'HEVC';
    case VP8 = 'VP8';
    case VP9 = 'VP9';
}
