# Livepeer PHP SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cranbri/livepeer-php.svg)](https://packagist.org/packages/cranbri/livepeer-php)
[![Tests](https://github.com/cranbri/livepeer-php/actions/workflows/tests.yml/badge.svg)](https://github.com/cranbri/livepeer-php/actions/workflows/tests.yml)
[![PHPStan](https://github.com/cranbri/livepeer-php/actions/workflows/phpstan.yml/badge.svg)](https://github.com/cranbri/livepeer-php/actions/workflows/phpstan.yml)
[![Check Styling](https://github.com/cranbri/livepeer-php/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/cranbri/livepeer-php/actions/workflows/php-cs-fixer.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/cranbri/livepeer-php.svg)](https://packagist.org/packages/cranbri/livepeer-php)
[![License](https://img.shields.io/github/license/cranbri/livepeer-php)](https://github.com/cranbri/livepeer-php/blob/main/LICENSE.md)

A modern PHP client for the [Livepeer Studio API](https://docs.livepeer.org/reference/api/overview), built on [Saloon](https://docs.saloon.dev/).

## Features

- Full API coverage for Livepeer Studio
- Type-safe request/response handling
- Modern PHP 8.1+ with strict typing
- Comprehensive test suite
- Exception handling
- Expressive fluent interface
- PSR-12 compliant

## Requirements

- PHP 8.1 or higher
- Composer

## Installation

You can install the package via composer:

```bash
composer require cranbri/livepeer-php
```

## Usage

### Initializing the Client

```php
use Cranbri\Livepeer\Livepeer;

// Initialize with your Livepeer API key
$livepeer = new Livepeer('your-api-key');
```

### Asset Management

```php
// Request asset upload
$upload = $livepeer->requestAssetUpload(new UploadAssetData(
    name: 'My Video',
    playbackPolicy: PlaybackPolicyData::public()
));

// Upload an asset via URL
$asset = $livepeer->uploadAssetFromUrl(new UrlUploadAssetData(
    name: 'My Video',
    url: 'https://example.com/video.mp4',
    playbackPolicy: PlaybackPolicyData::public()
));

// Get an asset by ID
$asset = $livepeer->getAsset('asset-id');

// List all assets
$assets = $livepeer->listAssets();

// Update an asset
$livepeer->updateAsset('asset-id', new UpdateAssetData(
    name: 'Updated Video Name',
    playbackPolicy: PlaybackPolicyData::public()
));

// Delete an asset
$livepeer->deleteAsset('asset-id');
```

### Livestreaming

```php
// Create a new livestream
$stream = $livepeer->createLivestream(new CreateLivestreamData(
    name: 'My Livestream',
    record: true,
    playbackPolicy: PlaybackPolicyData::public()
));

// Get stream details
$stream = $livepeer->getLivestream('stream-id');

// Update a stream
$livepeer->updateLivestream('stream-id', new UpdateLivestreamData(
    name: 'Updated Stream Name',
    record: true
));

// List all streams
$streams = $livepeer->listLivestreams();

// List with filters
$filteredStreams = $livepeer->listLivestreams([
    'record' => true,
    'creatorId' => 'creator-123'
]);

// Delete a stream
$livepeer->deleteLivestream('stream-id');

// Terminate an active stream
$livepeer->terminateLivestream('stream-id');

// Create a clip from livestream
$clip = $livepeer->createClip(new CreateClipData(
    playbackId: 'playback-id',
    startTime: 60000,  // in milliseconds
    endTime: 120000,   // in milliseconds
    name: 'My Clip'
));

// List clips for a stream
$clips = $livepeer->listClips('stream-id');
```

### Multistreaming

```php
// Create a multistream target
$target = $livepeer->createMultistreamTarget(new CreateTargetData(
    url: 'rtmp://example.com/live',
    name: 'YouTube Target'
));

// Get a target by ID
$target = $livepeer->getMultistreamTarget('target-id');

// Update a target
$livepeer->updateMultistreamTarget('target-id', new UpdateTargetData(
    url: 'rtmp://example.com/updated',
    name: 'Updated Target',
    disabled: false
));

// List all targets
$targets = $livepeer->listMultistreamTargets();

// Delete a target
$livepeer->deleteMultistreamTarget('target-id');

// Add a target to a stream
$livepeer->addMultistreamTarget('stream-id', new AddMultistreamTargetData(
    source: 'source',
    id: 'target-id'
));

// Remove a target from a stream
$livepeer->removeMultistreamTarget('stream-id', 'target-id');
```

### Webhooks

```php
// Create a webhook
$webhook = $livepeer->createWebhook(new CreateWebhookData(
    name: 'Stream Events',
    url: 'https://example.com/webhook',
    events: [
        WebhookEvent::STREAM_STARTED,
        WebhookEvent::STREAM_IDLE
    ]
));

// Get a webhook
$webhook = $livepeer->getWebhook('webhook-id');

// Update a webhook
$livepeer->updateWebhook('webhook-id', new UpdateWebhookData(
    name: 'Updated Stream Events',
    url: 'https://example.com/updated-webhook',
    events: [
        WebhookEvent::STREAM_STARTED,
        WebhookEvent::STREAM_IDLE,
        WebhookEvent::RECORDING_READY
    ]
));

// List all webhooks
$webhooks = $livepeer->listWebhooks();

// Delete a webhook
$livepeer->deleteWebhook('webhook-id');
```

### Sessions and Playback

```php
// Get a session by ID
$session = $livepeer->getSession('session-id');

// List all sessions
$sessions = $livepeer->listSessions();

// List recorded sessions for a stream
$recordedSessions = $livepeer->listRecordedSessions('stream-id');

// List clips for a session
$sessionClips = $livepeer->listSessionClips('session-id');

// Get playback info
$playbackInfo = $livepeer->getPlaybackInfo('playback-id');
```

### Tasks

```php
// Get a task by ID
$task = $livepeer->getTask('task-id');

// List all tasks
$tasks = $livepeer->listTasks();

// Transcode a video
$task = $livepeer->transcodeVideo(new CreateTranscodingData(
    input: new UrlInputData('https://example.com/video.mp4'),
    storage: new Web3StorageData(new Web3CredentialsData('your-token')),
    outputs: new TranscodeOutputData(
        hls: ['path' => '/path/to/hls'],
        mp4: ['path' => '/path/to/mp4'],
        fmp4: ['path' => '/path/to/fmp4']
    )
));
```

### Access Control

```php
// Create a signing key
$key = $livepeer->createSigningKey();

// Get a signing key
$key = $livepeer->getSigningKey('key-id');

// Update a signing key
$livepeer->updateSigningKey('key-id', new UpdateSigningKeyData(
    name: 'Updated Key',
    disabled: false
));

// List signing keys
$keys = $livepeer->listSigningKeys();

// Delete a signing key
$livepeer->deleteSigningKey('key-id');
```

### Analytics

```php
// Query realtime viewership
$viewers = $livepeer->queryRealtimeViewership([
    'playbackId' => 'playback-id',
    'breakdownBy' => 'country'
]);

// Query viewership metrics
$viewershipMetrics = $livepeer->queryViewershipMetrics([
    'fromTime' => '2024-01-01T00:00:00Z',
    'toTime' => '2024-01-31T23:59:59Z',
    'playbackId' => 'playback-id',
    'breakdownBy' => 'browser'
]);

// Query usage metrics
$usageMetrics = $livepeer->queryUsageMetrics([
    'fromTime' => '2024-01-01T00:00:00Z',
    'toTime' => '2024-01-31T23:59:59Z',
    'timeStep' => '1d'
]);

// Query public total views metrics
$totalViews = $livepeer->queryPublicTotalViewsMetrics('playback-id');

// Query creator viewership metrics
$creatorViewership = $livepeer->queryCreatorViewershipMetrics([
    'fromTime' => '2024-01-01T00:00:00Z',
    'toTime' => '2024-01-31T23:59:59Z',
    'creatorId' => 'creator-id'
]);
```

## Advanced Usage

### Stream Profiles

```php
// Create a stream with specific profiles
$stream = $livepeer->createLivestream(new CreateLivestreamData(
    name: 'HD Stream',
    profiles: [
        StreamProfileData::hd720(),
        StreamProfileData::sd480(),
        StreamProfileData::hd1080(),
        StreamProfileData::uhd4k()
    ]
));

// Custom stream profile
$customProfile = new StreamProfileData(
    bitrate: 2500000,
    name: 'custom-720p',
    width: 1280,
    height: 720,
    fps: 30,
    encoder: EncoderType::H264
);
```

### Playback Policies

```php
// Public playback (default)
$publicPolicy = PlaybackPolicyData::public();

// JWT playback (requires signing key)
$jwtPolicy = PlaybackPolicyData::jwt();

// Webhook playback
$webhookPolicy = PlaybackPolicyData::webhook(
    webhookId: 'webhook-id',
    webhookContext: ['user' => 'user-123']
);

// With custom allowed origins
$customPolicy = new PlaybackPolicyData(
    type: PlaybackPolicyType::PUBLIC,
    allowedOrigins: ['https://example.com', 'https://app.example.com']
);
```

## Error Handling

All API errors are converted to `LivepeerException` instances:

```php
use Cranbri\Livepeer\Livepeer;
use Cranbri\Livepeer\Exceptions\LivepeerException;

try {
    $livepeer = new Livepeer('invalid-api-key');
    $assets = $livepeer->listAssets();
} catch (LivepeerException $e) {
    echo "Error: " . $e->getMessage();
    echo "HTTP Status: " . $e->getCode();
    
    // Get the full response if available
    if ($response = $e->getResponse()) {
        $responseBody = $e->getResponseBody();
        // Handle error details
    }
}
```

## API Reference

For detailed information about all available methods and data structures, please refer to the [API Documentation](https://docs.livepeer.org/api-reference).

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email security@cranbri.agency instead of using the issue tracker.

## Credits

- [Tom Burman](https://github.com/yourusername)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.