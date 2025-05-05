<?php

use Cranbri\Livepeer\Data\AddMultistreamTargetData;
use Cranbri\Livepeer\Data\Livestream\CreateClipData;
use Cranbri\Livepeer\Data\Livestream\CreateLivestreamData;
use Cranbri\Livepeer\Data\Livestream\CreateMultistreamTargetData;
use Cranbri\Livepeer\Data\Livestream\UpdateLivestreamData;
use Cranbri\Livepeer\Data\StreamProfileData;
use Cranbri\Livepeer\Livepeer;

beforeEach(function () {
    $this->livepeer = new Livepeer($_ENV['LIVEPEER_API_KEY']);
});

test('can create a livestream', function () {
    $streamName = testResourceName('Stream');

    $data = new CreateLivestreamData(
        name: $streamName,
        profiles: [
            StreamProfileData::hd720(),
            StreamProfileData::sd480(),
        ],
        record: true
    );

    $response = $this->livepeer->createLivestream($data);

    expect($response)
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->toHaveKey('playbackId')
        ->toHaveKey('streamKey')
        ->and($response['name'])->toBe($streamName)
        ->and($response['record'])->toBeTrue();
});

test('can list livestreams', function () {
    $streams = $this->livepeer->listLivestreams();

    expect($streams)
        ->toBeArray()
        ->when(
            fn () => count($streams) > 0,
            fn ($streams) => $streams->and($streams->value[0])->toHaveKey('id')
        );
});

test('can get a livestream', function () {
    $streams = $this->livepeer->listLivestreams();

    if (empty($streams)) {
        $this->markTestSkipped('No streams available for testing');
    }

    $streamId = $streams[0]['id'];
    $stream = $this->livepeer->getLivestream($streamId);

    expect($stream)
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->and($stream['id'])->toBe($streamId);
})->depends('can create a livestream');

test('can list livestreams with filters', function () {
    $streamName = testResourceName('Stream');

    $data = new CreateLivestreamData(
        name: $streamName,
        profiles: [
            StreamProfileData::hd720(),
            StreamProfileData::sd480(),
        ],
        record: false
    );

    $this->livepeer->createLivestream($data);

    $streams = $this->livepeer->listLivestreams(['streamsonly' => true]);

    expect($streams)
        ->toBeArray();
});

test('can update a livestream', function () {
    $streams = $this->livepeer->listLivestreams();

    if (empty($streams)) {
        $this->markTestSkipped('No streams available for testing');
    }

    $streamId = $streams[0]['id'];

    $newName = testResourceName('Updated Stream');

    $data = new UpdateLivestreamData(
        name: $newName,
        record: true
    );

    $this->livepeer->updateLivestream($streamId, $data);

    $stream = $this->livepeer->getLivestream($streamId);

    expect($stream)
        ->toHaveKey('name')
        ->and($stream['name'])->toBe($newName);
})->depends('can create a livestream');

test('can list clips for a stream', function () {
    $streams = $this->livepeer->listLivestreams();

    if (empty($streams)) {
        $this->markTestSkipped('No streams available for testing');
    }

    $streamId = $streams[0]['id'];

    $clips = $this->livepeer->listClips($streamId);

    expect($clips)->toBeArray();
});

// Termination test - Skip by default since it affects active streams
test('can terminate a livestream', function () {
    $streams = $this->livepeer->listLivestreams();

    if (empty($streams)) {
        $this->markTestSkipped('No streams available for testing');
    }

    $streamId = $streams[0]['id'];

    // Note: This will only work if the stream is currently active
    $response = $this->livepeer->terminateLivestream($streamId);

    expect($response)->not->toHaveKey('error');
})->depends('can create a livestream')
  ->skip('Skip by default since streams may not be active');

test('can add multistream target to stream', function () {
    $streams = $this->livepeer->listLivestreams();

    if (empty($streams)) {
        $this->markTestSkipped('No streams available for testing');
    }

    $streamId = $streams[0]['id'];

    $data = new AddMultistreamTargetData(
        profile: 'source',
        spec: new CreateMultistreamTargetData(
            url: 'rtmps://live.my-service.tv/channel/secretKey',
            name: $streams[0]['name'] . ' target'
        )
    );

    $response = $this->livepeer->addMultistreamTarget($streamId, $data);

    expect($response)
        ->toBeArray()
        ->and($response['name'])
        ->toBe($streams[0]['name'] . ' target');

    $stream = $this->livepeer->getLivestream($streamId);

    expect($stream['multistream'])
        ->toBeArray()
        ->toHaveKey('targets')
        ->and($stream['multistream']['targets'][0]['profile'])
        ->toBe('source');
});

test('can remove multistream target from stream', function () {
    $streamName = testResourceName('Stream');

    $data = new CreateLivestreamData(
        name: $streamName,
        profiles: [
            StreamProfileData::hd720(),
            StreamProfileData::sd480(),
        ],
        record: true
    );

    $stream = $this->livepeer->createLivestream($data);

    $data = new AddMultistreamTargetData(
        profile: 'source',
        spec: new CreateMultistreamTargetData(
            url: 'rtmps://live.my-service.tv/channel/secretKey',
            name: $stream['name'] . ' target'
        )
    );

    $response = $this->livepeer->addMultistreamTarget($stream['id'], $data);
    $this->livepeer->removeMultistreamTarget($stream['id'], $response['id']);

    $stream = $this->livepeer->getLivestream($stream['id']);

    expect($stream['multistream']['targets'])
        ->toBeEmpty();
});

test('can create a clip of a livestream', function () {
    $streamName = testResourceName('Stream');

    $data = new CreateLivestreamData(
        name: $streamName,
        profiles: [
            StreamProfileData::hd720(),
        ],
    );

    $stream = $this->livepeer->createLivestream($data);

    $clipData = new CreateClipData(
        playbackId: $stream['playbackId'],
        startTime: 1000,
        endTime: 5000,
        name: testResourceName('Clip')
    );

    // Note: This will only work if the stream is currently active
    $response = $this->livepeer->createClip($clipData);

    expect($response)
        ->toHaveKeys(['task', 'asset'])
        ->and($response['task'])
        ->toHaveKey('id')
        ->and($response['asset'])
        ->toHaveKey('id');
})->skip('Skip by default since streams may not be active');
//});

test('can list all clips of a stream', function () {
    $streamName = testResourceName('Stream');

    $data = new CreateLivestreamData(
        name: $streamName,
        profiles: [
            StreamProfileData::hd720(),
        ],
    );

    $stream = $this->livepeer->createLivestream($data);

    $clipData = new CreateClipData(
        playbackId: $stream['playbackId'],
        startTime: 1000,
        endTime: 5000,
        name: testResourceName('Clip')
    );

    // Note: This will only work if the stream is currently active
    $this->livepeer->createClip($clipData);
    $response = $this->livepeer->listClips($stream['id']);

    expect($response)
        ->toBeArray()
        ->toHaveLength(1);
})->skip('Skip by default since streams may not be active and clips may not be generated.');
//});

test('can delete a livestream', function () {
    $streamsToDelete = $this->livepeer->listLivestreams();

    if (empty($streamsToDelete)) {
        $this->markTestSkipped('No streams to delete');
    }

    foreach ($streamsToDelete as $stream) {
        $response = $this->livepeer->deleteLivestream($stream['id']);
        expect($response)->not->toHaveKey('error');
    }
});
