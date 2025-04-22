<?php

use Cranbri\Livepeer\Requests\Asset\ListAssetsRequest;
use Saloon\Enums\Method;

test('list assets request can be created', function () {
    $request = new ListAssetsRequest();

    expect($request)
        ->toBeInstanceOf(ListAssetsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/asset')
        ->and($request->getMethod())->toBe(Method::GET);
});

test('list assets request can be created with query parameters', function () {
    $request = new ListAssetsRequest;

    expect($request)
        ->toBeInstanceOf(ListAssetsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/asset')
        ->and($request->getMethod())->toBe(Method::GET)
        ->and($request->query()->all())->toBe([
            'creatorId' => 'test-creator',
            'status' => 'ready',
        ]);
});
