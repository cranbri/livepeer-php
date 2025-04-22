<?php

use Cranbri\Livepeer\Data\Multistream\CreateTargetData;
use Cranbri\Livepeer\Requests\Multistream\CreateTargetRequest;
use Saloon\Enums\Method;

test('create target request can be created', function () {
    $data = new CreateTargetData(
        url: 'rtmp://example.com/live',
        name: 'test-target',
        disabled: false,
    );

    $request = new CreateTargetRequest($data);

    expect($request)
        ->toBeInstanceOf(CreateTargetRequest::class)
        ->and($request->resolveEndpoint())->toBe('/multistream/target')
        ->and($request->getMethod())->toBe(Method::POST)
        ->and($request->body()->all())->toBe([
            'url' => 'rtmp://example.com/live',
            'name' => 'test-target',
            'disabled' => false,
        ]);

});
