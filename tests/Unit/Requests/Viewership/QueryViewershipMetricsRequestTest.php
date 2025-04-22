<?php

use Cranbri\Livepeer\Requests\Viewership\QueryViewershipMetricsRequest;
use Saloon\Enums\Method;

test('query viewership metrics request architecture', function () {
    expect(QueryViewershipMetricsRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('query viewership metrics request has correct endpoint', function () {
    $request = new QueryViewershipMetricsRequest();
    expect($request->resolveEndpoint())->toBe('/data/views/query');
});

test('query viewership metrics request can be created with filters', function () {
    $filters = [
        'fromTime' => '2024-01-01T00:00:00Z',
        'toTime' => '2024-01-31T23:59:59Z',
        'playbackId' => 'test-playback-id',
        'breakdownBy' => 'browser'
    ];

    $request = new QueryViewershipMetricsRequest($filters);

    expect($request)
        ->toBeInstanceOf(QueryViewershipMetricsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/data/views/query')
        ->and($request->getMethod())->toBe(Method::GET)
        ->and($request->query()->all())->toBe($filters);
});
