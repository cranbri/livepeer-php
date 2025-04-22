<?php

use Cranbri\Livepeer\Requests\Multistream\GetTargetRequest;
use Saloon\Enums\Method;

test('get target request can be created', function () {
    $request = new GetTargetRequest('test-target-id');

    expect($request)
        ->toBeInstanceOf(GetTargetRequest::class)
        ->and($request->resolveEndpoint())->toBe('/multistream/target/test-target-id')
        ->and($request->getMethod())->toBe(Method::GET);
});
