<?php

namespace App\Services;

use App\Repositories\TaskRepository;

interface ProviderInterface
{
    public function __construct(TaskRepository $taskRepository);
    public function fetch(): array;
    public function save(array $task): void;
}
