<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Enums;

enum PlaybackPolicyType: string
{
    case PUBLIC = 'public';
    case JWT = 'jwt';
    case WEBHOOK = 'webhook';
}
