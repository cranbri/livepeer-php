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

test('can list sessions', function () {
    $sessions = $this->livepeer->listSessions();

    expect($sessions)->toBeArray();
});

test('can get a session by ID', function () {
    $sessions = $this->livepeer->listSessions();

    if (empty($sessions)) {
        $this->markTestSkipped('No session ID available for testing');
    }

    $sessionId = $sessions[0]['id'];

    $session = $this->livepeer->getSession(
        sessionId: $sessionId
    );

    expect($session)
        ->toHaveKey('id')
        ->and($session['id'])->toBe($sessionId);
});

test('can list recorded sessions for a stream', function () {
    $liveStreams = $this->livepeer->listLivestreams();

    if (empty($liveStreams)) {
        $this->markTestSkipped('No livestream available for testing');
    }

    $liveStreamsId = $liveStreams[0]['id'];

    $sessions = $this->livepeer->listRecordedSessions(parentId: $liveStreamsId);

    expect($sessions)->toBeArray();
});

test('can list clips for a session', function () {
    $sessions = $this->livepeer->listSessions();

    if (empty($sessions)) {
        $this->markTestSkipped('No session ID available for testing');
    }

    $sessionId = $sessions[0]['id'];

    $clips = $this->livepeer->listSessionClips(sessionId: $sessionId);

    expect($clips)->toBeArray();
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
