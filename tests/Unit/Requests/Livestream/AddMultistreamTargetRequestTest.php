<?php

use Cranbri\Livepeer\Data\AddMultistreamTargetData;
use Cranbri\Livepeer\Requests\Livestream\AddMultistreamTargetRequest;
use Saloon\Enums\Method;

test('add multistream target request can be created', function () {
    $data = new AddMultistreamTargetData(
        source: 'source',
        videoOnly: false,
        id: 'test-target-id',
    );

    $request = new AddMultistreamTargetRequest('test-stream-id', $data);

    expect($request)
        ->toBeInstanceOf(AddMultistreamTargetRequest::class)
        ->and($request->resolveEndpoint())->toBe('/stream/test-stream-id/create-multistream-target')
        ->and($request->getMethod())->toBe(Method::POST)
        ->and($request->body()->all())->toBe([
            'source' => 'source',
            'videoOnly' => false,
            'id' => 'test-target-id',
        ]);

});
