<?php

use Cranbri\Livepeer\Requests\Livestream\RemoveMultistreamTargetRequest;
use Saloon\Enums\Method;

test('remove multistream target request can be created', function () {
    $request = new RemoveMultistreamTargetRequest('test-stream-id', 'test-target-id');

    expect($request)
        ->toBeInstanceOf(RemoveMultistreamTargetRequest::class)
        ->and($request->resolveEndpoint())->toBe('/stream/test-stream-id/multistream/test-target-id')
        ->and($request->getMethod())->toBe(Method::DELETE);
});
