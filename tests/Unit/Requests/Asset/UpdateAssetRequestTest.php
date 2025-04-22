<?php

use Cranbri\Livepeer\Data\PlaybackPolicyData;
use Cranbri\Livepeer\Data\Asset\UpdateAssetData;
use Cranbri\Livepeer\Requests\Asset\UpdateAssetRequest;
use Saloon\Enums\Method;

test('update asset request can be created', function () {
    $data = new UpdateAssetData(
        name: 'updated-asset',
        playbackPolicy: PlaybackPolicyData::public(),
        creatorId: null,
        storage: null,
    );

    $request = new UpdateAssetRequest('test-asset-id', $data);

    expect($request)
        ->toBeInstanceOf(UpdateAssetRequest::class)
        ->and($request->resolveEndpoint())->toBe('/asset/test-asset-id')
        ->and($request->getMethod())->toBe(Method::PATCH)
        ->and($request->body()->all())->toBe([
            'name' => 'updated-asset',
            'playbackPolicy' => [
                'type' => 'public',
            ],
        ]);

});

test('update asset request can be created with minimal data', function () {
    $data = new UpdateAssetData(
        name: 'updated-asset'
    );

    $request = new UpdateAssetRequest('test-asset-id', $data);

    expect($request->body()->all())->toBe([
        'name' => 'updated-asset',
    ]);
});
