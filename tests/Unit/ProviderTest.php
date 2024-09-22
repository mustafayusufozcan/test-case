<?php

namespace Tests\Unit;

use App\Repositories\TaskRepository;
use App\Services\ProviderOneService;
use App\Services\ProviderTwoService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ProviderTest extends TestCase
{
    public function test_provider_one_returns_correct_data(): void
    {
        $service = new ProviderOneService(new TaskRepository);

        Http::fake([
            $service::URL => Http::response([
                [
                    'id' => 1,
                    'value' => 2,
                    'estimated_duration' => 3
                ]
            ])
        ]);

        $response = $service->fetch();
        $this->assertEquals([
            'success' => true,
            'body' => [
                [
                    'id' => 1,
                    'value' => 2,
                    'estimated_duration' => 3
                ]
            ]
        ], $response);
    }

    public function test_provider_one_returns_error(): void
    {
        $service = new ProviderOneService(new TaskRepository);

        Http::fake([
            $service::URL => Http::response([], 500)
        ]);

        $response = $service->fetch();
        $this->assertContains(false, $response);
    }

    public function test_provider_two_returns_correct_data(): void
    {
        $service = new ProviderTwoService(new TaskRepository);

        Http::fake([
            $service::URL => Http::response([
                [
                    'id' => 1,
                    'zorluk' => 2,
                    'sure' => 3
                ]
            ])
        ]);

        $response = $service->fetch();
        $this->assertEquals([
            'success' => true,
            'body' => [
                [
                    'id' => 1,
                    'zorluk' => 2,
                    'sure' => 3
                ]
            ]
        ], $response);
    }

    public function test_provider_two_returns_error(): void
    {
        $service = new ProviderTwoService(new TaskRepository);

        Http::fake([
            $service::URL => Http::response([], 500)
        ]);

        $response = $service->fetch();
        $this->assertContains(false, $response);
    }
}
