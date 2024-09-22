<?php

namespace App\Console\Commands;

use App\Factories\ProviderFactory;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fetches tasks from providers.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $providers = config('providers');

        foreach ($providers as $provider) {
            try {
                $service = ProviderFactory::create($provider);
                $response = $service->fetch();

                if (!$response['success']) {
                    throw new Exception($response['body']);
                }

                foreach ($response['body'] as $task) {
                    $service->save($task);
                }
            } catch (Exception $e) {
                Log::channel('command')->error($e->getMessage());
            }
        }
    }
}
