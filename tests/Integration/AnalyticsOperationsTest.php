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

test('can query realtime viewership', function () {
    $liveStreams = $this->livepeer->listLivestreams();
    $livestream = $liveStreams[0];

    $response = $this->livepeer->queryRealtimeViewership([
        'playbackId' => $livestream['playbackId'],
    ]);

    expect($response)->toBeArray();
});

test('can query viewership metrics', function () {
    $liveStreams = $this->livepeer->listLivestreams();
    $livestream = $liveStreams[0];
    $toTime = date('c');
    $fromTime = date('c', strtotime('-24 hours'));

    $response = $this->livepeer->queryViewershipMetrics([
        'playbackId' => $livestream['playbackId'],
        'fromTime' => $fromTime,
        'toTime' => $toTime,
    ]);

    expect($response)->toBeArray();
});

test('can query usage metrics', function () {
    $response = $this->livepeer->queryUsageMetrics([
        'timeStep' => 'day',
    ]);

    expect($response)->toBeArray();
});

test('can query public total views metrics', function () {
    $liveStreams = $this->livepeer->listLivestreams();
    $livestream = $liveStreams[0];

    $response = $this->livepeer->queryPublicTotalViewsMetrics(
        playbackId: $livestream['playbackId']
    );

    expect($response)
        ->toBeArray()
        ->toHaveKey('viewCount');
});

test('can query creator viewership metrics', function () {
    $liveStreams = $this->livepeer->listLivestreams();
    $livestream = $liveStreams[0];

    $response = $this->livepeer->queryCreatorViewershipMetrics([
        'streamId' => $livestream['id'],
    ]);

    expect($response)->toBeArray();
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
