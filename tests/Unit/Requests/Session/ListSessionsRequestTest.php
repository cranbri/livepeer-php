<?php

use Cranbri\Livepeer\Requests\Session\ListSessionsRequest;
use Saloon\Enums\Method;

test('list sessions request architecture', function () {
    expect(ListSessionsRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest()
        ->toUseAcceptsJsonTrait();
});

test('list sessions request has correct endpoint', function () {
    $request = new ListSessionsRequest();
    expect($request->resolveEndpoint())->toBe('/session');
});

test('list sessions request can be created', function () {
    $request = new ListSessionsRequest();

    expect($request)
        ->toBeInstanceOf(ListSessionsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/session')
        ->and($request->getMethod())->toBe(Method::GET);
});
