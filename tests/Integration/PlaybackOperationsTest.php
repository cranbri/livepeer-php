<?php

use Cranbri\Livepeer\Data\Livestream\CreateLivestreamData;
use Cranbri\Livepeer\Livepeer;

beforeEach(function () {
    $this->livepeer = new Livepeer($_ENV['LIVEPEER_API_KEY']);
    $this->livepeer->createLivestream(new CreateLivestreamData(
        name: testResourceName('Analytics Test Stream'),
        record: true
    ));
});

test('can get playback info', function () {
    $liveStreams = $this->livepeer->listLivestreams();
    $livestream = $liveStreams[0];

    if (empty($livestream)) {
        $this->markTestSkipped('No livestream available for testing');
    }

    $playbackInfo = $this->livepeer->getPlaybackInfo(playbackId: $livestream['playbackId']);

    expect($playbackInfo)
        ->toHaveKey('type')
        ->toHaveKey('meta');
});

afterEach(function () {
    $streamsToDelete = $this->livepeer->listLivestreams();

    if (empty($streamsToDelete)) {
        $this->markTestSkipped('No streams to delete');
    }

    foreach ($streamsToDelete as $stream) {
        $response = $this->livepeer->deleteLivestream($stream['id']);
        expect($response)->not->toHaveKey('error');
    }
});
