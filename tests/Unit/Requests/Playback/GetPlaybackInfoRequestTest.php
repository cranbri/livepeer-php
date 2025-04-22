<?php

use Cranbri\Livepeer\Requests\Playback\GetPlaybackInfoRequest;
use Saloon\Enums\Method;

test('get playback info request architecture', function () {
    expect(GetPlaybackInfoRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest()
        ->toUseAcceptsJsonTrait();
});

test('get playback info request has correct endpoint', function () {
    $request = new GetPlaybackInfoRequest('test-playback-id');
    expect($request->resolveEndpoint())->toBe('/playback/test-playback-id');
});

test('get playback info request can be created', function () {
    $request = new GetPlaybackInfoRequest('test-playback-id');

    expect($request)
        ->toBeInstanceOf(GetPlaybackInfoRequest::class)
        ->and($request->resolveEndpoint())->toBe('/playback/test-playback-id')
        ->and($request->getMethod())->toBe(Method::GET);
});
