<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FetchTasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_fetch_tasks_command(): void
    {
        Http::fake([
            'https://raw.githubusercontent.com/WEG-Technology/mock/refs/heads/main/mock-one' => Http::response([
                [
                    'id' => 1,
                    'value' => 2,
                    'estimated_duration' => 3
                ],
            ]),
            'https://raw.githubusercontent.com/WEG-Technology/mock/refs/heads/main/mock-two' => Http::response([
                [
                    'id' => 1,
                    'zorluk' => 5,
                    'sure' => 8
                ],
            ])
        ]);

        $this->artisan('app:fetch-tasks')->assertExitCode(0);
        $this->assertDatabaseCount('tasks', 2);
        $this->assertDatabaseHas('tasks', [
            'provider' => 'provider_one',
            'foreign_id' => 1,
        ]);
        $this->assertDatabaseHas('tasks', [
            'provider' => 'provider_two',
            'foreign_id' => 1,
        ]);
    }
}
