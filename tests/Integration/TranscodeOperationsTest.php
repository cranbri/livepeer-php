<?php

use Cranbri\Livepeer\Data\Transcode\CreateTranscodingData;
use Cranbri\Livepeer\Data\Transcode\Inputs\UrlInputData;
use Cranbri\Livepeer\Data\Transcode\S3CredentialsData;
use Cranbri\Livepeer\Data\Transcode\Storage\S3StorageData;
use Cranbri\Livepeer\Data\Transcode\TranscodeOutputData;
use Cranbri\Livepeer\Enums\TranscodeStorageType;
use Cranbri\Livepeer\Livepeer;

beforeEach(function () {
    $this->livepeer = new Livepeer($_ENV['LIVEPEER_API_KEY']);
    $this->testVideoUrl = $_ENV['TEST_VIDEO_URL'];
});

test('can transcode a given video by url', function () {
    $data = new CreateTranscodingData(
        input: new UrlInputData(
            url: $this->testVideoUrl
        ),
        storage: new S3StorageData(
            endpoint: $_ENV['TEST_S3_ENDPOINT'],
            bucket: $_ENV['TEST_S3_BUCKET'],
            credentials: new S3CredentialsData(
                accessKeyId: $_ENV['TEST_S3_ACCESS_ID'],
                secretAccessKey: $_ENV['TEST_S3_SECRET_KEY']
            ),
            type: TranscodeStorageType::S3
        ),
        outputs: new TranscodeOutputData(
            hls: [
                'path' => $_ENV['TEST_S3_OUTPUT_PATH'],
            ]
        )
    );

    $response = $this->livepeer->transcodeVideo($data);

    expect($response)
        ->toBeArray()
        ->toHaveKey('id')
        ->toHaveKey('status');
});
