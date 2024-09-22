<?php

namespace Tests\Feature;

use App\Models\Developer;
use App\Models\Task;
use Database\Seeders\DeveloperSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssignTasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_assign_tasks_command(): void
    {
        $tasks = [
            [
                'provider' => 'provider_one',
                'foreign_id' => 1,
                'difficulty' => 3,
                'duration' => 4
            ],
            [
                'provider' => 'provider_one',
                'foreign_id' => 2,
                'difficulty' => 6,
                'duration' => 12
            ],
            [
                'provider' => 'provider_one',
                'foreign_id' => 3,
                'difficulty' => 5,
                'duration' => 9
            ],
            [
                'provider' => 'provider_one',
                'foreign_id' => 4,
                'difficulty' => 5,
                'duration' => 5
            ],
            [
                'provider' => 'provider_one',
                'foreign_id' => 5,
                'difficulty' => 7,
                'duration' => 7
            ],
            [
                'provider' => 'provider_one',
                'foreign_id' => 6,
                'difficulty' => 3,
                'duration' => 5
            ],
            [
                'provider' => 'provider_one',
                'foreign_id' => 7,
                'difficulty' => 4,
                'duration' => 8
            ],
            [
                'provider' => 'provider_one',
                'foreign_id' => 8,
                'difficulty' => 6,
                'duration' => 3
            ],
            [
                'provider' => 'provider_one',
                'foreign_id' => 9,
                'difficulty' => 3,
                'duration' => 5
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }

        for ($i = 1; $i <= 5; $i++) {
            Developer::create([
                'name' => 'Developer #' . $i,
                'ratio' => $i
            ]);
        }

        $this->artisan('app:assign-tasks');

        $this->assertDatabaseHas('tasks', [
            'developer_id' => 5,
            'foreign_id' => 1
        ]);
        $this->assertDatabaseHas('tasks', [
            'developer_id' => 5,
            'foreign_id' => 2
        ]);
        $this->assertDatabaseHas('tasks', [
            'developer_id' => 4,
            'foreign_id' => 3
        ]);
        $this->assertDatabaseHas('tasks', [
            'developer_id' => 3,
            'foreign_id' => 4
        ]);
        $this->assertDatabaseHas('tasks', [
            'developer_id' => 4,
            'foreign_id' => 5
        ]);
        $this->assertDatabaseHas('tasks', [
            'developer_id' => 2,
            'foreign_id' => 6
        ]);
        $this->assertDatabaseHas('tasks', [
            'developer_id' => 3,
            'foreign_id' => 7
        ]);
        $this->assertDatabaseHas('tasks', [
            'developer_id' => 2,
            'foreign_id' => 8
        ]);
        $this->assertDatabaseHas('tasks', [
            'developer_id' => 1,
            'foreign_id' => 9
        ]);
    }
}
