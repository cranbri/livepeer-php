<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Task;

use Cranbri\Livepeer\Data\Task\CreateTaskData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateTaskRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * The task data
     *
     * @var CreateTaskData
     */
    protected CreateTaskData $data;

    /**
     * Create a new CreateTaskRequest instance
     *
     * @param CreateTaskData $data
     */
    public function __construct(CreateTaskData $data)
    {
        $this->data = $data;
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/task';
    }

    /**
     * Define the request body
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return $this->data->toArray();
    }
}
