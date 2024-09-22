<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class ProviderOneService implements ProviderInterface
{
    const KEY = 'provider_one';
    const URL = 'https://raw.githubusercontent.com/WEG-Technology/mock/refs/heads/main/mock-one';

    public function __construct(private TaskRepository $taskRepository) {}

    public function fetch(): array
    {
        $isSuccess = false;
        $body = null;

        try {
            $body = Http::get(self::URL)->throw()->json();
            $isSuccess = true;
        } catch (RequestException $e) {
            $body = 'Server connection failed: ' . $e->getMessage();
        } catch (Exception $e) {
            $body = 'An unexpected error occurred: ' . $e->getMessage();
        }

        return [
            'success' => $isSuccess,
            'body' => $body
        ];
    }

    public function save(array $task): void
    {
        $this->taskRepository->save(self::KEY, $task['id'], $task['value'], $task['estimated_duration']);
    }
}
