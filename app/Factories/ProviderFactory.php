<?php

namespace App\Factories;

use App\Services\ProviderInterface;
use Exception;

class ProviderFactory
{
    public static function create(string $provider): ProviderInterface
    {
        $service = app($provider);
        
        if (!$service instanceof ProviderInterface) {
            throw new Exception(sprintf('Class %s does not implement ProviderInterface!', $provider));
        }

        return $service;
    }
}
