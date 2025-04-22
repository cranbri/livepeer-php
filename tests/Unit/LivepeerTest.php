<?php

use Cranbri\Livepeer\Livepeer;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('livepeer sdk can be instantiated with api key', function () {
    $sdk = new Livepeer(getTestApiKey());
    expect($sdk)->toBeInstanceOf(Livepeer::class);
});

test('livepeer sdk throws exception with empty api key', function () {
    expect(fn() => new Livepeer(''))->toThrow(\InvalidArgumentException::class);
});

test('livepeer sdk can be mocked', function () {
    $mockClient = new MockClient([
        '*' => MockResponse::make([
            'data' => ['test' => true]
        ], 200)
    ]);

    $sdk = new Livepeer(getTestApiKey());
    $sdk->withMockClient($mockClient);

    $response = $sdk->asset()->getAll();
    expect($response->json())->toBe(['data' => ['test' => true]]);
});

test('livepeer sdk has all required service methods', function () {
    $sdk = new Livepeer(getTestApiKey());

    // Test all service methods are available
    expect($sdk)->toHaveMethod('asset')
        ->and($sdk)->toHaveMethod('livestream')
        ->and($sdk)->toHaveMethod('multistream')
        ->and($sdk)->toHaveMethod('session')
        ->and($sdk)->toHaveMethod('task')
        ->and($sdk)->toHaveMethod('transcode')
        ->and($sdk)->toHaveMethod('webhook')
        ->and($sdk)->toHaveMethod('viewership')
        ->and($sdk)->toHaveMethod('playback')
        ->and($sdk)->toHaveMethod('accessControl');
});
