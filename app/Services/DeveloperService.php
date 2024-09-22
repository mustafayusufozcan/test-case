<?php

namespace App\Services;

use App\Models\Developer;
use App\Models\Task;
use Illuminate\Support\Collection;

class DeveloperService
{
    public function getMostAvailableDeveloper(Collection $developers, Task $task): Developer
    {
        $developers = $developers->sortBy(function ($developer) use ($task) {
            $spentCapacity = $developer->capacity - $developer->remaining_capacity;
            $newTaskStartDuration = $spentCapacity / $developer->ratio;
            $newTaskDuration = $task->cost / $developer->ratio;
            $deliveryTime = $newTaskStartDuration + $newTaskDuration;
            
            return $deliveryTime;
        });

        return $developers->first();
    }
}
