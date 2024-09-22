<?php

namespace App\Repositories;

use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\Log;

class TaskRepository
{
    public function save(string $providerKey, int $id, int $difficulty, int $duration): void
    {
        try {
            if (Task::where('provider', $providerKey)->where('foreign_id', $id)->exists()) {
                return;
            }

            Task::create([
                'provider' => $providerKey,
                'foreign_id' => $id,
                'difficulty' => $difficulty,
                'duration' => $duration
            ]);
        } catch (Exception $e) {
            Log::channel('repository')->error(sprintf('Failed to save data for %s: %s. ID: %u', $providerKey, $e->getMessage(), $id));
        }
    }
}
