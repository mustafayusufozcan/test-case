<?php

namespace App\Services;

use App\Models\Developer;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskService
{
    public function getUnassignedTasks(): Collection
    {
        return Task::whereNull('developer_id')->get();
    }

    public function assignTask(Task $task, Developer $developer): void
    {
        $workDuration = $task->cost / $developer->ratio;
        $deliveryDuration = $developer->hours_until_next_availability + $workDuration;
        $task->update([
            'developer_id' => $developer->id,
            'work_duration' => $workDuration,
            'delivery_duration' => $deliveryDuration
        ]);
    }
}
