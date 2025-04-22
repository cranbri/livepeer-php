<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\AccessControl;


use Cranbri\Livepeer\Data\BaseData;

class UpdateSigningKeyData extends BaseData
{
    /**
     * Create a new UpdateSigningKeyData instance
     *
     * @param ?bool $disabled
     * @param ?string  $name
     */
    public function __construct(
        public ?bool $disabled = false,
        public ?string $name = null,
    ) {
    }
}
