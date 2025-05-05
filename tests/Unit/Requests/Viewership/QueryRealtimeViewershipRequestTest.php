<?php

use Cranbri\Livepeer\Requests\Viewership\QueryRealtimeViewershipRequest;
use Saloon\Enums\Method;

test('query realtime viewership request architecture', function () {
    expect(QueryRealtimeViewershipRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('query realtime viewership request has correct endpoint', function () {
    $request = new QueryRealtimeViewershipRequest();
    expect($request->resolveEndpoint())->toBe('/data/views/now');
});

test('query realtime viewership request can be created with filters', function () {
    $filters = [
        'playbackId' => 'test-playback-id',
        'breakdownBy' => 'country',
    ];

    $request = new QueryRealtimeViewershipRequest($filters);

    expect($request)
        ->toBeInstanceOf(QueryRealtimeViewershipRequest::class)
        ->and($request->resolveEndpoint())->toBe('/data/views/now')
        ->and($request->getMethod())->toBe(Method::GET)
        ->and($request->query()->all())->toBe($filters);
});
