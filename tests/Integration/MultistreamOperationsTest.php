<?php

use Cranbri\Livepeer\Data\Multistream\CreateTargetData;
use Cranbri\Livepeer\Data\Multistream\UpdateTargetData;
use Cranbri\Livepeer\Livepeer;

beforeEach(function () {
    $this->livepeer = new Livepeer($_ENV['LIVEPEER_API_KEY']);
});

test('can create a multistream target', function () {
    $targetName = testResourceName('Target');
    $targetUrl = 'rtmp://example.com/live/' . uniqid();

    $data = new CreateTargetData(
        url: $targetUrl,
        name: $targetName
    );

    $response = $this->livepeer->createMultistreamTarget($data);

    expect($response)
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->and($response['name'])->toBe($targetName);
});

test('can list multistream targets', function () {
    $targets = $this->livepeer->listMultistreamTargets(userId: $_ENV['LIVEPEER_USER_ID']);

    expect($targets)
        ->toBeArray()
        ->when(
            fn () => count($targets) > 0,
            fn ($targets) => $targets->and($targets->value[0])->toHaveKey('id')
        );
});

test('can get a multistream target', function () {
    $targets = $this->livepeer->listMultistreamTargets(userId: $_ENV['LIVEPEER_USER_ID']);

    if (empty($targets)) {
        $this->markTestSkipped('No target ID available for testing');
    }

    $targetId = $targets[0]['id'];

    $target = $this->livepeer->getMultistreamTarget($targetId);

    expect($target)
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->and($target['id'])->toBe($targetId);
});

test('can update a multistream target', function () {
    $targets = $this->livepeer->listMultistreamTargets(userId: $_ENV['LIVEPEER_USER_ID']);

    if (empty($targets)) {
        $this->markTestSkipped('No target ID available for testing');
    }

    $targetId = $targets[0]['id'];

    $newName = testResourceName('Updated Target');
    $newUrl = 'rtmp://example.com/live/updated-' . uniqid();

    $data = new UpdateTargetData(
        url: $newUrl,
        name: $newName,
        disabled: false
    );

    $response = $this->livepeer->updateMultistreamTarget($targetId, $data);

    $target = $this->livepeer->getMultistreamTarget($targetId);
    expect($target)
        ->toHaveKey('name')
        ->and($target['name'])->toBe($newName);
});

test('can delete a multistream target', function () {
    $targetsToDelete = $this->livepeer->listMultistreamTargets(userId: $_ENV['LIVEPEER_USER_ID']);

    if (empty($targetsToDelete)) {
        $this->markTestSkipped('No targets to delete');
    }

    foreach ($targetsToDelete as $target) {
        $response = $this->livepeer->deleteMultistreamTarget($target['id']);
        expect($response)->not->toHaveKey('error');
    }
});
