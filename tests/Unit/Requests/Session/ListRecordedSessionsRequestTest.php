<?php

use Cranbri\Livepeer\Requests\Session\ListRecordedSessionsRequest;
use Saloon\Enums\Method;

test('list recorded sessions request architecture', function () {
    expect(ListRecordedSessionsRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('list recorded sessions request has correct endpoint', function () {
    $request = new ListRecordedSessionsRequest('test-stream-id');
    expect($request->resolveEndpoint())->toBe('/stream/test-stream-id/sessions');
});

test('list recorded sessions request can be created', function () {
    $request = new ListRecordedSessionsRequest('test-stream-id');

    expect($request)
        ->toBeInstanceOf(ListRecordedSessionsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/stream/test-stream-id/sessions')
        ->and($request->getMethod())->toBe(Method::GET);
});
