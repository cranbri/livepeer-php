<?php

declare(strict_types=1);

namespace Cranbri\Livepeer;

use Cranbri\Livepeer\Data\AccessControl\UpdateSigningKeyData;
use Cranbri\Livepeer\Data\AddMultistreamTargetData;
use Cranbri\Livepeer\Data\Asset\UpdateAssetData;
use Cranbri\Livepeer\Data\Asset\UploadAssetData;
use Cranbri\Livepeer\Data\Asset\UrlUploadAssetData;
use Cranbri\Livepeer\Data\Livestream\CreateClipData;
use Cranbri\Livepeer\Data\Livestream\CreateLivestreamData;
use Cranbri\Livepeer\Data\Livestream\UpdateLivestreamData;
use Cranbri\Livepeer\Data\Multistream\CreateTargetData;
use Cranbri\Livepeer\Data\Multistream\UpdateTargetData;
use Cranbri\Livepeer\Data\Transcode\CreateTranscodingData;
use Cranbri\Livepeer\Data\Webhook\CreateWebhookData;
use Cranbri\Livepeer\Data\Webhook\UpdateWebhookData;
use Cranbri\Livepeer\Enums\src\Requests\AccessControl\ListSigningKeysRequest;
use Cranbri\Livepeer\Enums\src\Requests\Asset\GetAssetRequest;
use Cranbri\Livepeer\Enums\src\Requests\Livestream\GetLivestreamRequest;
use Cranbri\Livepeer\Enums\src\Requests\Livestream\UpdateLivestreamRequest;
use Cranbri\Livepeer\Enums\src\Requests\Multistream\GetTargetRequest;
use Cranbri\Livepeer\Enums\src\Requests\Session\ListRecordedSessionsRequest;
use Cranbri\Livepeer\Enums\src\Requests\Task\ListTasksRequest;
use Cranbri\Livepeer\Enums\src\Requests\Webhook\ListWebhooksRequest;
use Cranbri\Livepeer\Exceptions\LivepeerException;
use Cranbri\Livepeer\Requests\AccessControl\CreateSigningKeyRequest;
use Cranbri\Livepeer\Requests\AccessControl\DeleteSigningKeyRequest;
use Cranbri\Livepeer\Requests\AccessControl\GetSigningKeyRequest;
use Cranbri\Livepeer\Requests\AccessControl\UpdateSigningKeyRequest;
use Cranbri\Livepeer\Requests\Asset\DeleteAssetRequest;
use Cranbri\Livepeer\Requests\Asset\ListAssetsRequest;
use Cranbri\Livepeer\Requests\Asset\RequestUploadRequest;
use Cranbri\Livepeer\Requests\Asset\UpdateAssetRequest;
use Cranbri\Livepeer\Requests\Asset\UrlUploadRequest;
use Cranbri\Livepeer\Requests\Livestream\AddMultistreamTargetRequest;
use Cranbri\Livepeer\Requests\Livestream\CreateClipRequest;
use Cranbri\Livepeer\Requests\Livestream\CreateLivestreamRequest;
use Cranbri\Livepeer\Requests\Livestream\DeleteLivestreamRequest;
use Cranbri\Livepeer\Requests\Livestream\ListClipsRequest;
use Cranbri\Livepeer\Requests\Livestream\ListLivestreamsRequest;
use Cranbri\Livepeer\Requests\Livestream\RemoveMultistreamTargetRequest;
use Cranbri\Livepeer\Requests\Livestream\TerminateLivestreamRequest;
use Cranbri\Livepeer\Requests\Multistream\CreateTargetRequest;
use Cranbri\Livepeer\Requests\Multistream\DeleteTargetRequest;
use Cranbri\Livepeer\Requests\Multistream\ListTargetsRequest;
use Cranbri\Livepeer\Requests\Multistream\UpdateTargetRequest;
use Cranbri\Livepeer\Requests\Playback\GetPlaybackInfoRequest;
use Cranbri\Livepeer\Requests\Session\GetSessionRequest;
use Cranbri\Livepeer\Requests\Session\ListSessionClipsRequest;
use Cranbri\Livepeer\Requests\Session\ListSessionsRequest;
use Cranbri\Livepeer\Requests\Task\GetTaskRequest;
use Cranbri\Livepeer\Requests\Transcode\TranscodeVideoRequest;
use Cranbri\Livepeer\Requests\Viewership\QueryCreatorViewershipMetricsRequest;
use Cranbri\Livepeer\Requests\Viewership\QueryPublicTotalViewsMetricsRequest;
use Cranbri\Livepeer\Requests\Viewership\QueryRealtimeViewershipRequest;
use Cranbri\Livepeer\Requests\Viewership\QueryUsageMetricsRequest;
use Cranbri\Livepeer\Requests\Viewership\QueryViewershipMetricsRequest;
use Cranbri\Livepeer\Requests\Webhook\CreateWebhookRequest;
use Cranbri\Livepeer\Requests\Webhook\DeleteWebhookRequest;
use Cranbri\Livepeer\Requests\Webhook\GetWebhookRequest;
use Cranbri\Livepeer\Requests\Webhook\UpdateWebhookRequest;
use Exception;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Request;
use Saloon\Http\Response;

class Livepeer
{
    /**
     * The Livepeer connector
     *
     * @var LivepeerConnector
     */
    protected LivepeerConnector $connector;

    /**
     * Create a new Livepeer instance
     *
     * @param  string  $apiKey  The Livepeer API key
     * @param  string|null  $apiVersion  Optional API version
     */
    public function __construct(string $apiKey)
    {
        if (empty($apiKey)) {
            throw new LivepeerException('API Key is required.');
        }

        $this->connector = new LivepeerConnector($apiKey);
    }

    /**
     * Get the connector instance
     *
     * @return LivepeerConnector
     */
    public function connector(): LivepeerConnector
    {
        return $this->connector;
    }

    /**
     * Send a request and handle exceptions
     *
     * @param  Request  $request
     * @return Response
     * @throws LivepeerException
     */
    protected function send(Request $request): Response
    {
        try {
            return $this->connector->send(request: $request);
        } catch (RequestException $exception) {
            throw LivepeerException::fromResponse($exception->getResponse());
        }
    }

    /**
     * Create a new asset upload request
     *
     * @param  UploadAssetData  $data
     * @return mixed
     * @throws Exception
     */
    public function requestAssetUpload(UploadAssetData $data): mixed
    {
        return $this->send(new RequestUploadRequest(data: $data))->json();
    }

    /**
     * Upload a new asset via URL
     *
     * @param  UrlUploadAssetData  $data
     * @return mixed
     * @throws Exception
     */
    public function uploadAssetFromUrl(UrlUploadAssetData $data): mixed
    {
        return $this->send(new UrlUploadRequest(data: $data))->json();
    }

    /**
     * Get an asset by ID
     *
     * @param  string  $assetId
     * @return mixed
     * @throws Exception
     */
    public function getAsset(string $assetId): mixed
    {
        return $this->send(new GetAssetRequest(assetId: $assetId))->json();
    }

    /**
     * Update an asset by ID
     *
     * @param  string  $assetId
     * @param  UpdateAssetData  $data
     * @return mixed
     * @throws Exception
     */
    public function updateAsset(string $assetId, UpdateAssetData $data): mixed
    {
        return $this->send(new UpdateAssetRequest(assetId: $assetId, data: $data))->json();
    }

    /**
     * List all assets
     *
     * @return mixed
     * @throws Exception
     */
    public function listAssets(): mixed
    {
        return $this->send(new ListAssetsRequest())->json();
    }

    /**
     * Delete an asset by ID
     *
     * @param  string  $assetId
     * @return mixed
     * @throws Exception
     */
    public function deleteAsset(string $assetId): mixed
    {
        return $this->send(new DeleteAssetRequest(assetId: $assetId))->json();
    }

    /**
     * Create a new stream
     *
     * @param  CreateLivestreamData  $data
     * @return mixed
     * @throws Exception
     */
    public function createLivestream(CreateLivestreamData $data): mixed
    {
        return $this->send(new CreateLivestreamRequest(data: $data))->json();
    }

    /**
     * Get a livestream by ID
     *
     * @param  string  $streamId
     * @return mixed
     * @throws Exception
     */
    public function getLivestream(string $streamId): mixed
    {
        return $this->send(new GetLivestreamRequest(streamId: $streamId))->json();
    }

    /**
     * Update a livestream by ID
     *
     * @param  string  $streamId
     * @param  UpdateLivestreamData  $data
     * @return mixed
     * @throws Exception
     */
    public function updateLivestream(string $streamId, UpdateLivestreamData $data): mixed
    {
        return $this->send(new UpdateLivestreamRequest(streamId: $streamId, data: $data))->json();
    }

    /**
     * List all streams
     *
     * @param  array  $filters
     * @return mixed
     * @throws Exception
     */
    public function listLivestreams(array $filters = []): mixed
    {
        return $this->send(new ListLivestreamsRequest(filters: $filters))->json();
    }

    /**
     * Delete a stream by ID
     *
     * @param  string  $streamId
     * @return mixed
     * @throws Exception
     */
    public function deleteLivestream(string $streamId): mixed
    {
        return $this->send(new DeleteLivestreamRequest(streamId: $streamId))->json();
    }

    /**
     * Terminate a stream by ID
     *
     * @param  string  $streamId
     * @return mixed
     * @throws Exception
     */
    public function terminateLivestream(string $streamId): mixed
    {
        return $this->send(new TerminateLivestreamRequest(streamId: $streamId))->json();
    }

    /**
     * Add a multistream target to the livestream
     *
     * @param  string  $streamId
     * @param  AddMultistreamTargetData  $data
     * @return mixed
     * @throws Exception
     */
    public function addMultistreamTarget(string $streamId, AddMultistreamTargetData $data): mixed
    {
        return $this->send(new AddMultistreamTargetRequest(streamId: $streamId, data: $data))->json();
    }

    /**
     * Remove a multistream target to the livestream
     *
     * @param  string  $streamId
     * @param  string  $targetId
     * @return mixed
     * @throws Exception
     */
    public function removeMultistreamTarget(string $streamId, string $targetId): mixed
    {
        return $this->send(new RemoveMultistreamTargetRequest(streamId: $streamId, targetId: $targetId))->json();
    }

    /**
     * Create a clip of the livestream
     *
     * @param  CreateClipData  $data
     * @return mixed
     * @throws Exception
     */
    public function createClip(CreateClipData $data): mixed
    {
        return $this->send(new CreateClipRequest(data: $data))->json();
    }

    /**
     * Get a list of clips from the livestream
     *
     * @param  string  $streamId
     * @return mixed
     * @throws Exception
     */
    public function listClips(string $streamId): mixed
    {
        return $this->send(new ListClipsRequest(streamId: $streamId))->json();
    }

    /**
     * Get a task by ID
     *
     * @param  string  $taskId
     * @return mixed
     * @throws Exception
     */
    public function getTask(string $taskId): mixed
    {
        return $this->send(new GetTaskRequest($taskId))->json();
    }

    /**
     * List all tasks
     *
     * @return mixed
     * @throws Exception
     */
    public function listTasks(): mixed
    {
        return $this->send(new ListTasksRequest())->json();
    }

    /**
     * Create a new multistream target
     *
     * @param  CreateTargetData  $data
     * @return mixed
     * @throws Exception
     */
    public function createMultistreamTarget(CreateTargetData $data): mixed
    {
        return $this->send(new CreateTargetRequest($data))->json();
    }

    /**
     * Get a multistream target by ID
     *
     * @param  string  $targetId
     * @return mixed
     * @throws Exception
     */
    public function getMultistreamTarget(string $targetId): mixed
    {
        return $this->send(new GetTargetRequest(targetId: $targetId))->json();
    }

    /**
     * Update a multistream target by ID
     *
     * @param  string  $targetId
     * @param  UpdateTargetData  $data
     * @return mixed
     * @throws Exception
     */
    public function updateMultistreamTarget(string $targetId, UpdateTargetData $data): mixed
    {
        return $this->send(new UpdateTargetRequest(targetId: $targetId, data: $data))->json();
    }

    /**
     * List all multistream targets
     *
     * @return mixed
     * @throws Exception
     */
    public function listMultistreamTargets(): mixed
    {
        return $this->send(new ListTargetsRequest())->json();
    }

    /**
     * Delete a multistream target by ID
     *
     * @param  string  $targetId
     * @return mixed
     * @throws Exception
     */
    public function deleteMultistreamTarget(string $targetId): mixed
    {
        return $this->send(new DeleteTargetRequest(targetId: $targetId))->json();
    }

    /**
     * Get a session by ID
     *
     * @param  string  $sessionId
     * @return mixed
     * @throws Exception
     */
    public function getSession(string $sessionId): mixed
    {
        return $this->send(new GetSessionRequest(sessionId: $sessionId))->json();
    }

    /**
     * Get all sessions
     *
     * @return mixed
     * @throws Exception
     */
    public function listSessions(): mixed
    {
        return $this->send(new ListSessionsRequest())->json();
    }

    /**
     * List recorded sessions by stream ID
     *
     * @param  string  $parentId
     * @return mixed
     * @throws Exception
     */
    public function listRecordedSessions(string $parentId): mixed
    {
        return $this->send(new ListRecordedSessionsRequest(parentId: $parentId))->json();
    }

    /**
     * Get clips by session ID
     *
     * @param  string  $sessionId
     * @return mixed
     * @throws Exception
     */
    public function listSessionClips(string $sessionId): mixed
    {
        return $this->send(new ListSessionClipsRequest(sessionId: $sessionId))->json();
    }

    /**
     * Create a new signing key
     *
     * @return mixed
     * @throws Exception
     */
    public function createSigningKey(): mixed
    {
        return $this->send(new CreateSigningKeyRequest())->json();
    }

    /**
     * Get a signing key by ID
     *
     * @param  string  $keyId
     * @return mixed
     * @throws Exception
     */
    public function getSigningKey(string $keyId): mixed
    {
        return $this->send(new GetSigningKeyRequest(keyId: $keyId))->json();
    }

    /**
     * Update a signing key by ID
     *
     * @param  string  $keyId
     * @param  UpdateSigningKeyData  $data
     * @return mixed
     * @throws Exception
     */
    public function updateSigningKey(string $keyId, UpdateSigningKeyData $data): mixed
    {
        return $this->send(new UpdateSigningKeyRequest(keyId: $keyId, data: $data))->json();
    }

    /**
     * List all signing keys
     *
     * @return mixed
     * @throws Exception
     */
    public function listSigningKeys(): mixed
    {
        return $this->send(new ListSigningKeysRequest())->json();
    }

    /**
     * Delete a signing key by ID
     *
     * @param  string  $keyId
     * @return mixed
     * @throws Exception
     */
    public function deleteSigningKey(string $keyId): mixed
    {
        return $this->send(new DeleteSigningKeyRequest(keyId: $keyId))->json();
    }

    /**
     * Create a new webhook
     *
     * @param  CreateWebhookData  $data
     * @return mixed
     * @throws Exception
     */
    public function createWebhook(CreateWebhookData $data): mixed
    {
        return $this->send(new CreateWebhookRequest($data))->json();
    }

    /**
     * Get a webhook by ID
     *
     * @param  string  $webhookId
     * @return mixed
     * @throws Exception
     */
    public function getWebhook(string $webhookId): mixed
    {
        return $this->send(new GetWebhookRequest($webhookId))->json();
    }

    /**
     * Update a webhook by ID
     *
     * @param  string  $webhookId
     * @param  UpdateWebhookData  $data
     * @return mixed
     * @throws Exception
     */
    public function updateWebhook(string $webhookId, UpdateWebhookData $data): mixed
    {
        return $this->send(new UpdateWebhookRequest(webhookId: $webhookId, data: $data))->json();
    }

    /**
     * List all webhooks
     *
     * @return mixed
     * @throws Exception
     */
    public function listWebhooks(): mixed
    {
        return $this->send(new ListWebhooksRequest())->json();
    }

    /**
     * Delete a webhook by ID
     *
     * @param  string  $webhookId
     * @return mixed
     * @throws Exception
     */
    public function deleteWebhook(string $webhookId): mixed
    {
        return $this->send(new DeleteWebhookRequest($webhookId))->json();
    }

    /**
     * Get a playback info by ID
     *
     * @param  string  $playbackId
     * @return mixed
     * @throws Exception
     */
    public function getPlaybackInfo(string $playbackId): mixed
    {
        return $this->send(new GetPlaybackInfoRequest($playbackId))->json();
    }

    /**
     * Create a new video transcoding
     *
     * @param  CreateTranscodingData  $data
     * @return mixed
     * @throws Exception
     */
    public function transcodeVideo(CreateTranscodingData $data): mixed
    {
        return $this->send(new TranscodeVideoRequest($data))->json();
    }

    /**
     * Query Realtime Viewership
     *
     * @param  array  $filters
     * @return mixed
     * @throws Exception
     */
    public function queryRealtimeViewership(array $filters = []): mixed
    {
        return $this->send(new QueryRealtimeViewershipRequest(filters: $filters))->json();
    }

    /**
     * Query Viewership Metrics
     *
     * @param  array  $filters
     * @return mixed
     * @throws Exception
     */
    public function queryViewershipMetrics(array $filters = []): mixed
    {
        return $this->send(new QueryViewershipMetricsRequest(filters: $filters))->json();
    }

    /**
     * Query Usage Metrics
     *
     * @param  array  $filters
     * @return mixed
     * @throws Exception
     */
    public function queryUsageMetrics(array $filters = []): mixed
    {
        return $this->send(new QueryUsageMetricsRequest(filters: $filters))->json();
    }

    /**
     * Query Public Total Views Metrics
     *
     * @param  string  $playbackId
     * @return mixed
     * @throws Exception
     */
    public function queryPublicTotalViewsMetrics(string $playbackId): mixed
    {
        return $this->send(new QueryPublicTotalViewsMetricsRequest(playbackId: $playbackId))->json();
    }

    /**
     * Query creator viewership metrics
     *
     * @param  array  $filters
     * @return mixed
     * @throws Exception
     */
    public function queryCreatorViewershipMetrics(array $filters = []): mixed
    {
        return $this->send(new QueryCreatorViewershipMetricsRequest(filters: $filters))->json();
    }
}
