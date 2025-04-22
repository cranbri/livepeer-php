<?php

use Cranbri\Livepeer\Data\Multistream\UpdateTargetData;
use Cranbri\Livepeer\Requests\Multistream\UpdateTargetRequest;
use Saloon\Enums\Method;

test('update target request can be created', function () {
    $data = new UpdateTargetData(
        url: 'rtmp://example.com/live',
        name: 'updated-target',
        disabled: true,
    );

    $request = new UpdateTargetRequest('test-target-id', $data);

    expect($request)
        ->toBeInstanceOf(UpdateTargetRequest::class)
        ->and($request->resolveEndpoint())->toBe('/multistream/target/test-target-id')
        ->and($request->getMethod())->toBe(Method::PATCH)
        ->and($request->body())->toBe([
            'url' => 'rtmp://example.com/live',
            'name' => 'updated-target',
            'disabled' => true,
        ]);

});
