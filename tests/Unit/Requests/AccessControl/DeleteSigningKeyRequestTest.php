<?php

use Cranbri\Livepeer\Requests\AccessControl\DeleteSigningKeyRequest;
use Saloon\Enums\Method;

test('delete signing key request architecture', function () {
    expect(DeleteSigningKeyRequest::class)
        ->toBeSaloonRequest()
        ->toSendDeleteRequest();
});

test('delete signing key request has correct endpoint', function () {
    $keyId = 'test-key-id';
    $request = new DeleteSigningKeyRequest($keyId);
    expect($request->resolveEndpoint())->toBe('/access-control/signing-key/test-key-id');
});

test('delete signing key request can be created', function () {
    $keyId = 'test-key-id';
    $request = new DeleteSigningKeyRequest($keyId);

    expect($request)
        ->toBeInstanceOf(DeleteSigningKeyRequest::class)
        ->and($request->resolveEndpoint())->toBe('/access-control/signing-key/test-key-id')
        ->and($request->getMethod())->toBe(Method::DELETE);
});
