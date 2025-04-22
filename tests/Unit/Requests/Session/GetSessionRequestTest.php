<?php

use Cranbri\Livepeer\Requests\Session\GetSessionRequest;
use Saloon\Enums\Method;

test('get session request architecture', function () {
    expect(GetSessionRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest()
        ->toUseAcceptsJsonTrait();
});

test('get session request has correct endpoint', function () {
    $request = new GetSessionRequest('test-session-id');
    expect($request->resolveEndpoint())->toBe('/session/test-session-id');
});

test('get session request can be created', function () {
    $request = new GetSessionRequest('test-session-id');

    expect($request)
        ->toBeInstanceOf(GetSessionRequest::class)
        ->and($request->resolveEndpoint())->toBe('/session/test-session-id')
        ->and($request->getMethod())->toBe(Method::GET);
});
