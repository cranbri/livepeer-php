<?php

use Cranbri\Livepeer\Exceptions\LivepeerException;
use Cranbri\Livepeer\Livepeer;

test('can initialize livepeer client with valid API key', function () {
    $livepeer = new Livepeer($_ENV['LIVEPEER_API_KEY']);
    expect($livepeer)->toBeInstanceOf(Livepeer::class);
});

test('throws exception with invalid API key', function () {
    $livepeer = new Livepeer('invalid-api-key-' . uniqid());

    expect(fn () => $livepeer->listAssets())->toThrow(LivepeerException::class);
});

test('connector returns base URL', function () {
    $livepeer = new Livepeer($_ENV['LIVEPEER_API_KEY']);
    expect($livepeer->connector()->resolveBaseUrl())->toBe('https://livepeer.studio/api');
});
