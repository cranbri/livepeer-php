<?php

use Cranbri\Livepeer\LivepeerConnector;
use Cranbri\Livepeer\Requests\AccessControl\CreateSigningKeyRequest;
use Saloon\Enums\Method;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('create signing key request architecture', function () {
    expect(CreateSigningKeyRequest::class)
        ->toBeSaloonRequest()
        ->toSendPostRequest()
        ->toHaveJsonBody();
});

test('create signing key request has correct endpoint', function () {
    $request = new CreateSigningKeyRequest();
    expect($request->resolveEndpoint())->toBe('/access-control/signing-key');
});

test('create signing key request can be created', function () {
    $request = new CreateSigningKeyRequest();

    expect($request)
        ->toBeInstanceOf(CreateSigningKeyRequest::class)
        ->and($request->resolveEndpoint())->toBe('/access-control/signing-key')
        ->and($request->getMethod())->toBe(Method::POST);
});

test('create signing key request sends correct body', function () {
    $request = new CreateSigningKeyRequest();
    expect($request->body()->all())->toBeEmpty();
});

test('create signing key request returns mocked response', function () {
    $mockClient = new MockClient([
        CreateSigningKeyRequest::class => MockResponse::make([
            'id' => 'test-key-id',
            'name' => 'Test Signing Key',
            'publicKey' => 'test-public-key',
            'privateKey' => 'test-private-key',
            'createdAt' => '2024-01-01T00:00:00Z',
        ], 201),
    ]);

    $connector = new LivepeerConnector(getTestApiKey());
    $connector->withMockClient($mockClient);

    $response = $connector->send(new CreateSigningKeyRequest());

    expect($response->json())
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->toHaveKey('publicKey')
        ->toHaveKey('privateKey')
        ->toHaveKey('createdAt')
        ->and($response->status())->toBe(201);
});
