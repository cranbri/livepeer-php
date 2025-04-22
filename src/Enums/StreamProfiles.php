<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Enums;

enum StreamProfiles: string
{
    case H264BASELINE = 'H264Baseline';
    case H264MAIN = 'H264Main';
    case H264HIGH = 'H264High';
    case H264CONSTRAINED_HIGH = 'H264ConstrainedHigh';
}
