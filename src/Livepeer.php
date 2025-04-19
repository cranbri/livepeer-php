<?php

declare(strict_types=1);


namespace Cranbri\Livepeer;

use Cranbri\Livepeer\Exceptions\LivepeerException;
use Cranbri\Livepeer\Requests\Asset\CreateAssetRequest;
use Cranbri\Livepeer\Requests\Asset\DeleteAssetRequest;
use Cranbri\Livepeer\Requests\Asset\GetAssetRequest;
use Cranbri\Livepeer\Requests\Asset\ListAssetsRequest;
use Cranbri\Livepeer\Requests\Stream\CreateStreamRequest;
use Cranbri\Livepeer\Requests\Stream\DeleteStreamRequest;
use Cranbri\Livepeer\Requests\Stream\GetStreamRequest;
use Cranbri\Livepeer\Requests\Stream\ListStreamsRequest;
use Cranbri\Livepeer\Requests\Task\CreateTaskRequest;
use Cranbri\Livepeer\Requests\Task\GetTaskRequest;
use Cranbri\Livepeer\Requests\Task\ListTasksRequest;
use Cranbri\Livepeer\Requests\Multistream\CreateTargetRequest;
use Cranbri\Livepeer\Requests\Multistream\DeleteTargetRequest;
use Cranbri\Livepeer\Requests\Multistream\GetTargetRequest;
use Cranbri\Livepeer\Requests\Multistream\ListTargetsRequest;
use Cranbri\Livepeer\Requests\Webhook\CreateWebhookRequest;
use Cranbri\Livepeer\Requests\Webhook\DeleteWebhookRequest;
use Cranbri\Livepeer\Requests\Webhook\GetWebhookRequest;
use Cranbri\Livepeer\Requests\Webhook\ListWebhooksRequest;
use Cranbri\Livepeer\Data\Asset\CreateAssetData;
use Cranbri\Livepeer\Data\Stream\CreateStreamData;
use Cranbri\Livepeer\Data\Task\CreateTaskData;
use Cranbri\Livepeer\Data\Multistream\CreateTargetData;
use Cranbri\Livepeer\Data\Webhook\CreateWebhookData;
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
     * @param Request $request
     * @return Response
     * @throws LivepeerException
     */
    protected function send(Request $request): Response
    {
        try {
            return $this->connector->send($request);
        } catch (RequestException $exception) {
            throw LivepeerException::fromResponse($exception->getResponse());
        }
    }

    /**
     * Create a new asset
     *
     * @param  CreateAssetData  $data
     * @return mixed
     * @throws \Exception
     */
    public function createAsset(CreateAssetData $data)
    {
        return $this->send(new CreateAssetRequest($data))->json();
    }

    /**
     * Get an asset by ID
     *
     * @param  string  $assetId
     * @return mixed
     * @throws \Exception
     */
    public function getAsset(string $assetId)
    {
        return $this->send(new GetAssetRequest($assetId))->json();
    }

    /**
     * List all assets
     *
     * @param  array  $filters
     * @return mixed
     * @throws \Exception
     */
    public function listAssets(array $filters = [])
    {
        return $this->send(new ListAssetsRequest($filters))->json();
    }

    /**
     * Delete an asset by ID
     *
     * @param  string  $assetId
     * @return mixed
     * @throws \Exception
     */
    public function deleteAsset(string $assetId)
    {
        return $this->send(new DeleteAssetRequest($assetId))->json();
    }

    /**
     * Create a new stream
     *
     * @param  CreateStreamData  $data
     * @return mixed
     * @throws \Exception
     */
    public function createStream(CreateStreamData $data)
    {
        return $this->send(new CreateStreamRequest($data))->json();
    }

    /**
     * Get a stream by ID
     *
     * @param  string  $streamId
     * @return mixed
     * @throws \Exception
     */
    public function getStream(string $streamId)
    {
        return $this->send(new GetStreamRequest($streamId))->json();
    }

    /**
     * List all streams
     *
     * @param  array  $filters
     * @return mixed
     * @throws \Exception
     */
    public function listStreams(array $filters = [])
    {
        return $this->send(new ListStreamsRequest($filters))->json();
    }

    /**
     * Delete a stream by ID
     *
     * @param  string  $streamId
     * @return mixed
     * @throws \Exception
     */
    public function deleteStream(string $streamId)
    {
        return $this->send(new DeleteStreamRequest($streamId))->json();
    }

    /**
     * Create a new task
     *
     * @param  CreateTaskData  $data
     * @return mixed
     * @throws \Exception
     */
    public function createTask(CreateTaskData $data)
    {
        return $this->send(new CreateTaskRequest($data))->json();
    }

    /**
     * Get a task by ID
     *
     * @param  string  $taskId
     * @return mixed
     * @throws \Exception
     */
    public function getTask(string $taskId)
    {
        return $this->send(new GetTaskRequest($taskId))->json();
    }

    /**
     * List all tasks
     *
     * @param  array  $filters
     * @return mixed
     * @throws \Exception
     */
    public function listTasks(array $filters = [])
    {
        return $this->send(new ListTasksRequest($filters))->json();
    }

    /**
     * Create a new multistream target
     *
     * @param  string  $streamId
     * @param  CreateTargetData  $data
     * @return mixed
     * @throws \Exception
     */
    public function createMultistreamTarget(string $streamId, CreateTargetData $data)
    {
        return $this->send(new CreateTargetRequest($streamId, $data))->json();
    }

    /**
     * Get a multistream target by ID
     *
     * @param  string  $streamId
     * @param  string  $targetId
     * @return mixed
     * @throws \Exception
     */
    public function getMultistreamTarget(string $streamId, string $targetId)
    {
        return $this->send(new GetTargetRequest($streamId, $targetId))->json();
    }

    /**
     * List all multistream targets
     *
     * @param  string  $streamId
     * @param  array  $filters
     * @return mixed
     * @throws \Exception
     */
    public function listMultistreamTargets(string $streamId, array $filters = [])
    {
        return $this->send(new ListTargetsRequest($streamId, $filters))->json();
    }

    /**
     * Delete a multistream target by ID
     *
     * @param  string  $streamId
     * @param  string  $targetId
     * @return mixed
     * @throws \Exception
     */
    public function deleteMultistreamTarget(string $streamId, string $targetId)
    {
        return $this->send(new DeleteTargetRequest($streamId, $targetId))->json();
    }

    /**
     * Create a new webhook
     *
     * @param  CreateWebhookData  $data
     * @return mixed
     * @throws \Exception
     */
    public function createWebhook(CreateWebhookData $data)
    {
        return $this->send(new CreateWebhookRequest($data))->json();
    }

    /**
     * Get a webhook by ID
     *
     * @param  string  $webhookId
     * @return mixed
     * @throws \Exception
     */
    public function getWebhook(string $webhookId)
    {
        return $this->send(new GetWebhookRequest($webhookId))->json();
    }

    /**
     * List all webhooks
     *
     * @param  array  $filters
     * @return mixed
     * @throws \Exception
     */
    public function listWebhooks(array $filters = [])
    {
        return $this->send(new ListWebhooksRequest($filters))->json();
    }

    /**
     * Delete a webhook by ID
     *
     * @param  string  $webhookId
     * @return mixed
     * @throws \Exception
     */
    public function deleteWebhook(string $webhookId)
    {
        return $this->send(new DeleteWebhookRequest($webhookId))->json();
    }
}
