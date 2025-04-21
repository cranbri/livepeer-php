<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data\Task;

use Cranbri\Livepeer\Data\DataObject;

class CreateTaskData extends DataObject
{
    /**
     * The name of the task
     *
     * @var string
     */
    protected string $name;

    /**
     * The input URL for the task
     *
     * @var string
     */
    protected string $inputUrl;

    /**
     * The output format for the task
     *
     * @var string
     */
    protected string $outputFormat;

    /**
     * The output URL for the task
     *
     * @var string
     */
    protected string $outputUrl;

    /**
     * Create a new CreateTaskData instance
     *
     * @param string $name
     * @param string $inputUrl
     * @param string $outputFormat
     * @param string $outputUrl
     */
    public function __construct(
        string $name,
        string $inputUrl,
        string $outputFormat,
        string $outputUrl
    ) {
        $this->name = $name;
        $this->inputUrl = $inputUrl;
        $this->outputFormat = $outputFormat;
        $this->outputUrl = $outputUrl;
    }

    /**
     * Get the name of the task
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the input URL for the task
     *
     * @return string
     */
    public function getInputUrl(): string
    {
        return $this->inputUrl;
    }

    /**
     * Get the output format for the task
     *
     * @return string
     */
    public function getOutputFormat(): string
    {
        return $this->outputFormat;
    }

    /**
     * Get the output URL for the task
     *
     * @return string
     */
    public function getOutputUrl(): string
    {
        return $this->outputUrl;
    }
}
