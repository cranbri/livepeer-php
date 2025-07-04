<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data;

class StorageData extends BaseData
{
    /**
     * Create a new StorageData instance
     *
     * @param  array<string,string>|bool|null $ipfs  Set to true to make default export to IPFS. To customize the
     * pinned files, specify an object with a spec field. False or null
     * means to unpin from IPFS, but it's unsupported right now.
     */
    public function __construct(
        public array|bool|null $ipfs,
    ) {
    }
}
