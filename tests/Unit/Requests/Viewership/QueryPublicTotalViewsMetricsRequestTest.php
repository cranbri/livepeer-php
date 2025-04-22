<?php

use Cranbri\Livepeer\Requests\Viewership\QueryPublicTotalViewsMetricsRequest;
use Saloon\Enums\Method;

test('query public total views metrics request architecture', function () {
    expect(QueryPublicTotalViewsMetricsRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('query public total views metrics request has correct endpoint', function () {
    $playbackId = 'test-playback-id';
    $request = new QueryPublicTotalViewsMetricsRequest($playbackId);
    expect($request->resolveEndpoint())->toBe('/data/views/query/total/test-playback-id');
});

test('query public total views metrics request can be created', function () {
    $playbackId = 'test-playback-id';
    $request = new QueryPublicTotalViewsMetricsRequest($playbackId);

    expect($request)
        ->toBeInstanceOf(QueryPublicTotalViewsMetricsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/data/views/query/total/test-playback-id')
        ->and($request->getMethod())->toBe(Method::GET);
});
