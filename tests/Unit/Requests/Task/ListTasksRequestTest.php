<?php

use Cranbri\Livepeer\Requests\Task\ListTasksRequest;
use Saloon\Enums\Method;

test('list tasks request architecture', function () {
    expect(ListTasksRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('list tasks request has correct endpoint', function () {
    $request = new ListTasksRequest();
    expect($request->resolveEndpoint())->toBe('/task');
});

test('list tasks request can be created', function () {
    $request = new ListTasksRequest();

    expect($request)
        ->toBeInstanceOf(ListTasksRequest::class)
        ->and($request->resolveEndpoint())->toBe('/task')
        ->and($request->getMethod())->toBe(Method::GET);
});
