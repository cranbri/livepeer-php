<?php

use Cranbri\Livepeer\Requests\Multistream\DeleteTargetRequest;
use Saloon\Enums\Method;

test('delete target request can be created', function () {
    $request = new DeleteTargetRequest('test-target-id');

    expect($request)
        ->toBeInstanceOf(DeleteTargetRequest::class)
        ->and($request->resolveEndpoint())->toBe('/multistream/target/test-target-id')
        ->and($request->getMethod())->toBe(Method::DELETE);
});
