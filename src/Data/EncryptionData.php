<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Asset;

use Cranbri\Livepeer\Data\BaseData;

class EncryptionData extends BaseData
{
    /**
     * Create a new EncryptionData instance
     *
     * @param  string $encryptedKey  Encryption key used to encrypt the asset. Only writable in the upload asset endpoints and cannot be retrieved back.
     */
    public function __construct(
        public string $encryptedKey,
    ) {
    }
}