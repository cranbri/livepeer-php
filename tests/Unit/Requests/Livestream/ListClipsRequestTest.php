<?php

use Cranbri\Livepeer\Requests\Livestream\ListClipsRequest;
use Saloon\Enums\Method;

test('list clips request can be created', function () {
    $request = new ListClipsRequest('test-stream-id');

    expect($request)
        ->toBeInstanceOf(ListClipsRequest::class)
        ->and($request->resolveEndpoint())->toBe('/stream/test-stream-id/clips')
        ->and($request->getMethod())->toBe(Method::GET);
});
