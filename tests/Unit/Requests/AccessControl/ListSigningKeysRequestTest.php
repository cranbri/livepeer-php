<?php

use Cranbri\Livepeer\Requests\AccessControl\ListSigningKeysRequest;
use Saloon\Enums\Method;

test('list signing keys request architecture', function () {
    expect(ListSigningKeysRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('list signing keys request has correct endpoint', function () {
    $request = new ListSigningKeysRequest();
    expect($request->resolveEndpoint())->toBe('access-control/signing-key');
});

test('list signing keys request can be created', function () {
    $request = new ListSigningKeysRequest();

    expect($request)
        ->toBeInstanceOf(ListSigningKeysRequest::class)
        ->and($request->resolveEndpoint())->toBe('access-control/signing-key')
        ->and($request->getMethod())->toBe(Method::GET);
});
