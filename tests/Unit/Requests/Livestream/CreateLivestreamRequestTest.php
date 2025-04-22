<?php

use Cranbri\Livepeer\Data\Livestream\CreateLivestreamData;
use Cranbri\Livepeer\Data\PlaybackPolicyData;
use Cranbri\Livepeer\Requests\Livestream\CreateLivestreamRequest;
use Saloon\Enums\Method;

test('create livestream request can be created', function () {
    $data = new CreateLivestreamData(
        name: 'test-stream',
        playbackPolicy: PlaybackPolicyData::public(),
        creatorId: null,
        record: true,
        multistream: null,
    );

    $request = new CreateLivestreamRequest($data);

    expect($request)
        ->toBeInstanceOf(CreateLivestreamRequest::class)
        ->and($request->resolveEndpoint())->toBe('/stream')
        ->and($request->getMethod())->toBe(Method::POST)
        ->and($request->body()->all())->toBe([
            'name' => 'test-stream',
            'playbackPolicy' => [
                'type' => 'public',
            ],
            'record' => true,
        ]);

});

test('create livestream request can be created with minimal data', function () {
    $data = new CreateLivestreamData(
        name: 'test-stream'
    );

    $request = new CreateLivestreamRequest($data);

    expect($request->body()->all())->toBe([
        'name' => 'test-stream',
    ]);
});
