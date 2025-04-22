<?php

use Cranbri\Livepeer\Requests\Livestream\DeleteLivestreamRequest;
use Saloon\Enums\Method;

test('delete livestream request can be created', function () {
    $request = new DeleteLivestreamRequest('test-stream-id');

    expect($request)
        ->toBeInstanceOf(DeleteLivestreamRequest::class)
        ->and($request->resolveEndpoint())->toBe('/stream/test-stream-id')
        ->and($request->getMethod())->toBe(Method::DELETE);
});
