<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data;

use Cranbri\Livepeer\Enums\CreatorIdType;

class CreatorIdData extends BaseData
{
    /**
     * Create a new CreatorIdData instance
     *
     * @param  CreatorIdType  $type The creator ID type (unverified)
     * @param  string  $value  The value of the ID
     */
    public function __construct(
        public string $value,
        public CreatorIdType $type = CreatorIdType::UNVERIFIED
    ) {
    }
}
