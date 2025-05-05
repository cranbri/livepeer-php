<?php

use Cranbri\Livepeer\Requests\Viewership\QueryCreatorViewershipMetricsRequest;
use Saloon\Enums\Method;

test('query creator viewership metrics request architecture', function () {
    expect(QueryCreatorViewershipMetricsRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('query creator viewership metrics request has correct endpoint', function () {
    $request = new QueryCreatorViewershipMetricsRequest();
    expect($request->resolveEndpoint())->toBe('/data/views/query/creator');
});

test('query creator viewership metrics request can be created with filters', function () {
    $filters = [
        'fromTime' => '2024-01-01T00:00:00Z',
        'toTime' => '2024-01-31T23:59:59Z',
        'creatorId' => 'test-creator-id',
    ];

    $request = new QueryCreatorViewershipMetricsRequest($filters);

    expect($request)
        ->toBeInstanceOf(QueryCreatorViewershipMetricsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/data/views/query/creator')
        ->and($request->getMethod())->toBe(Method::GET)
        ->and($request->query()->all())->toBe($filters);
});
