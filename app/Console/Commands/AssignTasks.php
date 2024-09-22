<?php

namespace App\Console\Commands;

use App\Models\Developer;
use App\Services\DeveloperService;
use App\Services\TaskService;
use Illuminate\Console\Command;

class AssignTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command assign tasks to developers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $taskService = new TaskService();
        $developerService = new DeveloperService();

        $tasks = $taskService->getUnassignedTasks();
        $developers = Developer::all();

        foreach ($tasks as $task) {
            $developer = $developerService->getMostAvailableDeveloper($developers, $task);
            $taskService->assignTask($task, $developer);
        }
    }
}
