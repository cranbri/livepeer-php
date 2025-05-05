<?php

use Cranbri\Livepeer\Requests\Viewership\QueryUsageMetricsRequest;
use Saloon\Enums\Method;

test('query usage metrics request architecture', function () {
    expect(QueryUsageMetricsRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('query usage metrics request has correct endpoint', function () {
    $request = new QueryUsageMetricsRequest();
    expect($request->resolveEndpoint())->toBe('/data/usage/query');
});

test('query usage metrics request can be created with filters', function () {
    $filters = [
        'fromTime' => '2024-01-01T00:00:00Z',
        'toTime' => '2024-01-31T23:59:59Z',
        'timeStep' => '1d',
    ];

    $request = new QueryUsageMetricsRequest($filters);

    expect($request)
        ->toBeInstanceOf(QueryUsageMetricsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/data/usage/query')
        ->and($request->getMethod())->toBe(Method::GET)
        ->and($request->query()->all())->toBe($filters);
});
