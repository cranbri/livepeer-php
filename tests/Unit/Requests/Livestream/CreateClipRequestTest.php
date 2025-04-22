<?php

use Cranbri\Livepeer\Data\Livestream\CreateClipData;
use Cranbri\Livepeer\Requests\Livestream\CreateClipRequest;
use Saloon\Enums\Method;

test('create clip request can be created', function () {
    $data = new CreateClipData(
        playbackId: 'test-playback-id',
        startTime: 60,
        endTime: 120,
        name: 'test-clip',
    );

    $request = new CreateClipRequest($data);

    expect($request)
        ->toBeInstanceOf(CreateClipRequest::class)
        ->and($request->resolveEndpoint())->toBe('/clip')
        ->and($request->getMethod())->toBe(Method::POST)
        ->and($request->body()->all())->toBe([
            'playbackId' => 'test-playback-id',
            'startTime' => 60,
            'endTime' => 120,
            'name' => 'test-clip',
        ]);

});

test('create clip request can be created with minimal data', function () {
    $data = new CreateClipData(
        playbackId: 'test-playback-id',
        startTime: 60,
        endTime: 120,
    );

    $request = new CreateClipRequest($data);

    expect($request->body()->all())->toBe([
        'playbackId' => 'test-playback-id',
        'startTime' => 60,
        'endTime' => 120,
    ]);
});
