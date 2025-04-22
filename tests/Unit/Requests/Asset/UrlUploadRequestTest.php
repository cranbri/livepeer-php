<?php

use Cranbri\Livepeer\Data\PlaybackPolicyData;
use Cranbri\Livepeer\Data\Asset\UrlUploadAssetData;
use Cranbri\Livepeer\Requests\Asset\UrlUploadRequest;
use Saloon\Enums\Method;

test('url upload request can be created', function () {
    $data = new UrlUploadAssetData(
        name: 'test-asset',
        url: 'https://example.com/video.mp4',
        playbackPolicy: PlaybackPolicyData::public(),
        creatorId: null,
        storage: null,
    );

    $request = new UrlUploadRequest($data);

    expect($request)
        ->toBeInstanceOf(UrlUploadRequest::class)
        ->and($request->resolveEndpoint())->toBe('/asset/upload/url')
        ->and($request->getMethod())->toBe(Method::POST)
        ->and($request->body()->all())->toBe([
            'name' => 'test-asset',
            'url' => 'https://example.com/video.mp4',
            'playbackPolicy' => [
                'type' => 'public',
            ],
            'c2pa' => false,
        ]);

});

test('url upload request can be created with minimal data', function () {
    $data = new UrlUploadAssetData(
        name: 'test-asset',
        url: 'https://example.com/video.mp4'
    );

    $request = new UrlUploadRequest($data);

    expect($request->body()->all())->toBe([
        'name' => 'test-asset',
        'url' => 'https://example.com/video.mp4',
        'c2pa' => false,
    ]);
});
