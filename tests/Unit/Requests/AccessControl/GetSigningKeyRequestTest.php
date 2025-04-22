<?php

use Cranbri\Livepeer\Requests\AccessControl\GetSigningKeyRequest;
use Saloon\Enums\Method;

test('get signing key request architecture', function () {
    expect(GetSigningKeyRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('get signing key request has correct endpoint', function () {
    $keyId = 'test-key-id';
    $request = new GetSigningKeyRequest($keyId);
    expect($request->resolveEndpoint())->toBe('/access-control/signing-key/test-key-id');
});

test('get signing key request can be created', function () {
    $keyId = 'test-key-id';
    $request = new GetSigningKeyRequest($keyId);

    expect($request)
        ->toBeInstanceOf(GetSigningKeyRequest::class)
        ->and($request->resolveEndpoint())->toBe('/access-control/signing-key/test-key-id')
        ->and($request->getMethod())->toBe(Method::GET);
});
