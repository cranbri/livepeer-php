<?php

use Cranbri\Livepeer\Data\Livestream\UpdateLivestreamData;
use Cranbri\Livepeer\Data\PlaybackPolicyData;
use Cranbri\Livepeer\Requests\Livestream\UpdateLivestreamRequest;
use Saloon\Enums\Method;

test('update livestream request can be created', function () {
    $data = new UpdateLivestreamData(
        name: 'updated-stream',
        playbackPolicy: PlaybackPolicyData::public(),
        creatorId: null,
        record: true,
        multistream: null,
    );

    $request = new UpdateLivestreamRequest('test-stream-id', $data);

    expect($request)
        ->toBeInstanceOf(UpdateLivestreamRequest::class)
        ->and($request->resolveEndpoint())->toBe('/stream/test-stream-id')
        ->and($request->getMethod())->toBe(Method::PATCH)
        ->and($request->body()->all())->toBe([
            'name' => 'updated-stream',
            'playbackPolicy' => [
                'type' => 'public',
            ],
            'record' => true,
        ]);

});

test('update livestream request can be created with minimal data', function () {
    $data = new UpdateLivestreamData(
        name: 'updated-stream'
    );

    $request = new UpdateLivestreamRequest('test-stream-id', $data);

    expect($request->body()->all())->toBe([
        'name' => 'updated-stream',
    ]);
});
