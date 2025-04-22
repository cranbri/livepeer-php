<?php

use Cranbri\Livepeer\Requests\Livestream\TerminateLivestreamRequest;
use Saloon\Enums\Method;

test('terminate livestream request can be created', function () {
    $request = new TerminateLivestreamRequest('test-stream-id');

    expect($request)
        ->toBeInstanceOf(TerminateLivestreamRequest::class)
        ->and($request->resolveEndpoint())->toBe('/stream/test-stream-id/terminate')
        ->and($request->getMethod())->toBe(Method::DELETE);
});
