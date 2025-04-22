<?php

use Cranbri\Livepeer\Requests\Livestream\ListLivestreamsRequest;
use Saloon\Enums\Method;

test('list livestreams request can be created', function () {
    $request = new ListLivestreamsRequest();

    expect($request)
        ->toBeInstanceOf(ListLivestreamsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/stream')
        ->and($request->getMethod())->toBe(Method::GET);
});

test('list livestreams request can be created with query parameters', function () {
    $request = new ListLivestreamsRequest([
        'creatorId' => 'test-creator',
        'record' => true,
    ]);

    expect($request)
        ->toBeInstanceOf(ListLivestreamsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/stream')
        ->and($request->getMethod())->toBe(Method::GET)
        ->and($request->query()->all())->toBe([
            'creatorId' => 'test-creator',
            'record' => true,
        ]);
});
