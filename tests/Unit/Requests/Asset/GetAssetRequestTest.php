<?php

use Cranbri\Livepeer\Requests\Asset\GetAssetRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Enums\Method;

test('get asset request architecture', function () {
    expect(GetAssetRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest()
        ->toUseAcceptsJsonTrait();
});

test('get asset request has correct endpoint', function () {
    $request = new GetAssetRequest('test-asset-id');
    expect($request->resolveEndpoint())->toBe('/asset/test-asset-id');
});

test('get asset request returns mocked response', function () {
    $mockClient = new MockClient([
        GetAssetRequest::class => MockResponse::make([
            'id' => 'test-asset-id',
            'name' => 'Test Asset',
            'status' => 'ready'
        ], 200)
    ]);

    $request = new GetAssetRequest('test-asset-id');
    $response = $mockClient->send($request);

    expect($response->json())
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->toHaveKey('status')
        ->and($response->status())->toBe(200);
});

test('get asset request can be created', function () {
    $request = new GetAssetRequest('test-asset-id');

    expect($request)
        ->toBeInstanceOf(GetAssetRequest::class)
        ->and($request->resolveEndpoint())->toBe('/asset/test-asset-id')
        ->and($request->getMethod())->toBe(Method::GET);
});
