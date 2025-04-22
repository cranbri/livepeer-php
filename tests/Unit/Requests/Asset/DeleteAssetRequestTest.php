<?php

use Cranbri\Livepeer\Requests\Asset\DeleteAssetRequest;
use Saloon\Enums\Method;

test('delete asset request can be created', function () {
    $request = new DeleteAssetRequest('test-asset-id');

    expect($request)
        ->toBeInstanceOf(DeleteAssetRequest::class)
        ->and($request->resolveEndpoint())->toBe('/asset/test-asset-id')
        ->and($request->getMethod())->toBe(Method::DELETE);
});
