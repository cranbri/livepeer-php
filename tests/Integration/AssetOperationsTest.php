<?php

use Cranbri\Livepeer\Data\Asset\UpdateAssetData;
use Cranbri\Livepeer\Data\Asset\UploadAssetData;
use Cranbri\Livepeer\Data\Asset\UrlUploadAssetData;
use Cranbri\Livepeer\Livepeer;

beforeEach(function () {
    $this->livepeer = new Livepeer($_ENV['LIVEPEER_API_KEY']);
    $this->testVideoUrl = $_ENV['TEST_VIDEO_URL'];
});

test('can request upload for an asset', function () {
    $assetName = testResourceName('Asset');
    $data = new UploadAssetData(
        name: $assetName,
        staticMp4: true
    );

    $response = $this->livepeer->requestAssetUpload($data);
    $assetId = $response['asset']['id'];

    expect($response)
        ->toHaveKey('url')
        ->toHaveKey('tusEndpoint')
        ->toHaveKey('asset')
        ->and($response['asset'])->toHaveKey('id')
        ->and($response['asset']['name'])->toBe($assetName);
});

test('can upload asset from URL', function () {
    $assetName = testResourceName('URL Asset');
    $data = new UrlUploadAssetData(
        name: $assetName,
        url: $this->testVideoUrl
    );

    $response = $this->livepeer->uploadAssetFromUrl($data);

    $assetId = $response['asset']['id'];

    expect($response)
        ->toHaveKey('asset.id')
        ->toHaveKey('asset.name')
        ->and($response['asset']['name'])->toBe($assetName);

});

test('can list assets', function () {
    $assetName = testResourceName('Asset');
    $data = new UploadAssetData(
        name: $assetName,
        staticMp4: true
    );

    $this->livepeer->requestAssetUpload($data);
    $assets = $this->livepeer->listAssets();

    expect($assets)
        ->toBeArray()
        ->toHaveKey(0)
        ->when(
            fn () => count($assets) > 0,
            fn () => expect($assets[0])->toHaveKey('id')
        );
})->depends('can upload asset from URL');

test('can get asset by ID', function () {
    $assets = $this->livepeer->listAssets();
    if (empty($assets)) {
        $this->markTestSkipped('No assets available for testing');
    }
    $assetId = $assets[0]['id'];

    $asset = $this->livepeer->getAsset($assetId);

    expect($asset)
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->and($asset['id'])->toBe($assetId);
})->depends('can upload asset from URL');

test('can update asset', function () {
    $assets = $this->livepeer->listAssets();
    if (empty($assets)) {
        $this->markTestSkipped('No assets available for testing');
    }

    $testAsset = null;
    foreach ($assets as $asset) {
        if ($asset['name'] == 'test_asset_do_not_remove.mp4') {
            $testAsset = $asset;

            break;
        }
    }

    if (empty($testAsset)) {
        $this->markTestSkipped('No assets available for testing');
    }

    $newName = testResourceName('Updated Asset');
    $data = new UpdateAssetData(
        name: $newName,
    );

    $response = $this->livepeer->updateAsset($testAsset['id'], $data);

    expect($response)
        ->toHaveKey('name')
        ->and($response['name'])->toBe($newName);

    // revert back to testing name;
    $this->livepeer->updateAsset($testAsset['id'], new UpdateAssetData(name: 'test_asset_do_not_remove.mp4'));
});

test('can delete asset', function () {
    $assetsToDelete = $this->livepeer->listAssets();

    foreach ($assetsToDelete as $asset) {
        if ($asset['name'] == 'test_asset_do_not_remove.mp4') {
            continue;
        }
        $response = $this->livepeer->deleteAsset($asset['id']);
        expect($response)->not->toHaveKey('error');
    }
});
