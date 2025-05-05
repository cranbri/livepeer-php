<?php

use Cranbri\Livepeer\Data\Asset\UploadAssetData;
use Cranbri\Livepeer\Data\PlaybackPolicyData;
use Cranbri\Livepeer\Enums\PlaybackPolicyType;
use Cranbri\Livepeer\Requests\Asset\RequestUploadRequest;
use Saloon\Enums\Method;

test('request upload request can be created', function () {
    $data = new UploadAssetData(
        name: 'test-asset',
        playbackPolicy: new PlaybackPolicyData(
            type: PlaybackPolicyType::PUBLIC
        ),
        creatorId: null,
        storage: null,
    );

    $request = new RequestUploadRequest($data);

    expect($request)
        ->toBeInstanceOf(RequestUploadRequest::class)
        ->and($request->resolveEndpoint())->toBe('/asset/request-upload')
        ->and($request->getMethod())->toBe(Method::POST)
        ->and($request->body()->all())->toBe([
            'name' => 'test-asset',
            'playbackPolicy' => [
                'type' => 'public',
            ],
            'c2pa' => false,
        ]);

});

test('request upload request can be created with minimal data', function () {
    $data = new UploadAssetData(
        name: 'test-asset'
    );

    $request = new RequestUploadRequest($data);

    expect($request->body()->all())->toBe([
        'name' => 'test-asset',
        'c2pa' => false,
    ]);
});
