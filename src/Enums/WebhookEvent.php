<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Enums;

enum WebhookEvent: string
{
    case STREAM_STARTED = 'stream.started';
    case STREAM_IDLE = 'stream.idle';
    case RECORDING_READY = 'recording.ready';
    case RECORDING_STARTED = 'recording.started';
    case RECORDING_WAITING = 'recording.waiting';
    case MULTISTREAM_CONNECTED = 'multistream.connected';
    case MULTISTREAM_ERROR = 'multistream.error';
    case MULTISTREAM_DISCONNECTED = 'multistream.disconnected';
    case PLAYBACK_ACCESS_CONTROL = 'playback.accessControl';
    case ASSET_CREATED = 'asset.created';
    case ASSET_UPDATED = 'asset.updated';
    case ASSET_FAILED = 'asset.failed';
    case ASSET_READY = 'asset.ready';
    case ASSET_DELETED = 'asset.deleted';
    case TASK_SPAWNED = 'task.spawned';
    case TASK_UPDATED = 'task.updated';
    case TASK_COMPLETED = 'task.completed';
    case TASK_FAILED = 'task.failed';
}
