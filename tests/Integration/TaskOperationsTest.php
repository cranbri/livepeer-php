<?php

use Cranbri\Livepeer\Livepeer;

beforeEach(function () {
    $this->livepeer = new Livepeer($_ENV['LIVEPEER_API_KEY']);
});

test('can list tasks', function () {
    $tasks = $this->livepeer->listTasks();

    expect($tasks)
        ->toBeArray()
        ->when(
            fn () => count($tasks) > 0,
            fn ($tasks) => $tasks->and($tasks->value[0])->toHaveKey('id')
        );
});

test('can get a task', function () {
    $tasks = $this->livepeer->listTasks();

    if (empty($tasks)) {
        $this->markTestSkipped('No tasks available for testing');
    }

    $taskId = $tasks[0]['id'];

    $task = $this->livepeer->getTask(taskId: $taskId);

    expect($task)
        ->toHaveKey('id')
        ->toHaveKey('type');
});
