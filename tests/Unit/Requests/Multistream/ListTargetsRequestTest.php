<?php

use Cranbri\Livepeer\Requests\Multistream\ListTargetsRequest;
use Saloon\Enums\Method;

test('list targets request can be created', function () {
    $request = new ListTargetsRequest(userId: 'uuid');

    expect($request)
        ->toBeInstanceOf(ListTargetsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/multistream/target')
        ->and($request->getMethod())->toBe(Method::GET);
});
