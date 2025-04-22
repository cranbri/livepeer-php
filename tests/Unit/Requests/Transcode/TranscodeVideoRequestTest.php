<?php

use Cranbri\Livepeer\Data\Transcode\CreateTranscodingData;
use Cranbri\Livepeer\Data\Transcode\Inputs\UrlInputData;
use Cranbri\Livepeer\Data\Transcode\Storage\Web3StorageData;
use Cranbri\Livepeer\Data\Transcode\Web3CredentialsData;
use Cranbri\Livepeer\Data\Transcode\TranscodeOutputData;
use Cranbri\Livepeer\Requests\Transcode\TranscodeVideoRequest;
use Saloon\Enums\Method;

test('transcode video request architecture', function () {
    expect(TranscodeVideoRequest::class)
        ->toBeSaloonRequest()
        ->toSendPostRequest()
        ->toUseAcceptsJsonTrait();
});

test('transcode video request has correct endpoint', function () {
    $input = new UrlInputData('https://example.com/video.mp4');
    $credentials = new Web3CredentialsData('test-token');
    $storage = new Web3StorageData($credentials);
    $outputs = new TranscodeOutputData(
        hls: ['path' => '/path/to/hls'],
        mp4: ['path' => '/path/to/mp4'],
        fmp4: ['path' => '/path/to/fmp4']
    );
    $data = new CreateTranscodingData($input, $storage, $outputs);
    $request = new TranscodeVideoRequest($data);
    expect($request->resolveEndpoint())->toBe('/transcode');
});

test('transcode video request can be created', function () {
    $input = new UrlInputData('https://example.com/video.mp4');
    $credentials = new Web3CredentialsData('test-token');
    $storage = new Web3StorageData($credentials);
    $outputs = new TranscodeOutputData(
        hls: ['path' => '/path/to/hls'],
        mp4: ['path' => '/path/to/mp4'],
        fmp4: ['path' => '/path/to/fmp4']
    );
    $data = new CreateTranscodingData($input, $storage, $outputs);
    $request = new TranscodeVideoRequest($data);

    expect($request)
        ->toBeInstanceOf(TranscodeVideoRequest::class)
        ->and($request->resolveEndpoint())->toBe('/transcode')
        ->and($request->getMethod())->toBe(Method::POST);
});
