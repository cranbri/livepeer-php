<?php

use Cranbri\Livepeer\Exceptions\LivepeerException;
use Cranbri\Livepeer\Livepeer;

test('livepeer sdk can be instantiated with api key', function () {
    $sdk = new Livepeer(getTestApiKey());
    expect($sdk)->toBeInstanceOf(Livepeer::class);
});

test('livepeer sdk throws exception with empty api key', function () {
    expect(fn() => new Livepeer(''))->toThrow(LivepeerException::class, 'API Key is required.');
});
