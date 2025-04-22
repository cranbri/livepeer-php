<?php

use Cranbri\Livepeer\Requests\Livestream\GetLivestreamRequest;
use Saloon\Enums\Method;

test('get livestream request architecture', function () {
    expect(GetLivestreamRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('get livestream request has correct endpoint', function () {
    $request = new GetLivestreamRequest('test-stream-id');
    expect($request->resolveEndpoint())->toBe('/stream/test-stream-id');
});

test('get livestream request can be created', function () {
    $request = new GetLivestreamRequest('test-stream-id');

    expect($request)
        ->toBeInstanceOf(GetLivestreamRequest::class)
        ->and($request->resolveEndpoint())->toBe('/stream/test-stream-id')
        ->and($request->getMethod())->toBe(Method::GET);
});
