<?php

use Cranbri\Livepeer\Data\AccessControl\UpdateSigningKeyData;
use Cranbri\Livepeer\Requests\AccessControl\UpdateSigningKeyRequest;
use Saloon\Enums\Method;

test('update signing key request architecture', function () {
    expect(UpdateSigningKeyRequest::class)
        ->toBeSaloonRequest()
        ->toSendPatchRequest()
        ->toHaveJsonBody();
});

test('update signing key request has correct endpoint', function () {
    $keyId = 'test-key-id';
    $data = new UpdateSigningKeyData(
        disabled: false,
        name: 'Updated Key'
    );
    $request = new UpdateSigningKeyRequest($keyId, $data);
    expect($request->resolveEndpoint())->toBe('/access-control/signing-key/test-key-id');
});

test('update signing key request can be created with data', function () {
    $keyId = 'test-key-id';
    $keyName = 'Updated Key';

    $data = new UpdateSigningKeyData(
        disabled: false,
        name: $keyName
    );

    $request = new UpdateSigningKeyRequest($keyId, $data);

    expect($request)
        ->toBeInstanceOf(UpdateSigningKeyRequest::class)
        ->and($request->resolveEndpoint())->toBe('/access-control/signing-key/test-key-id')
        ->and($request->getMethod())->toBe(Method::PATCH)
        ->and($request->body()->all())->toBe([
            'disabled' => false,
            'name' => $keyName
        ]);
});
