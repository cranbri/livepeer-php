<?php

use Cranbri\Livepeer\Requests\Session\ListSessionClipsRequest;
use Saloon\Enums\Method;

test('list session clips request architecture', function () {
    expect(ListSessionClipsRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('list session clips request has correct endpoint', function () {
    $request = new ListSessionClipsRequest('test-session-id');
    expect($request->resolveEndpoint())->toBe('/session/test-session-id/clips');
});

test('list session clips request can be created', function () {
    $request = new ListSessionClipsRequest('test-session-id');

    expect($request)
        ->toBeInstanceOf(ListSessionClipsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/session/test-session-id/clips')
        ->and($request->getMethod())->toBe(Method::GET);
});
