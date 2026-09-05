<?php

namespace App\Http\Middleware;

use DateTime;
use Illuminate\Http\Request;
use Spatie\ResponseCache\CacheProfiles\CacheProfile as BaseCacheProfile;
use Symfony\Component\HttpFoundation\Response;

class CustomCacheProfile implements BaseCacheProfile
{
    public function shouldCacheRequest(Request $request): bool
    {
        // Jangan cache admin panel
        if ($request->is('admin*')) {
            return false;
        }

        // Jangan cache livewire requests
        if ($request->is('livewire/*')) {
            return false;
        }

        // Jangan cache contact form submission
        if ($request->is('contact') && $request->isMethod('POST')) {
            return false;
        }

        // Hanya cache GET requests
        return $request->isMethod('GET');
    }

    public function shouldCacheResponse(Response $response): bool
    {
        // Hanya cache response 200
        return $response->getStatusCode() === 200;
    }

    public function hashed(Request $request): string
    {
        $uri = $request->getUri();
        $method = $request->getMethod();
        
        return md5("{$uri}-{$method}");
    }

    public function useCacheNameSuffix(Request $request): string
    {
        return '';
    }

    public function enabled(Request $request): bool
    {
        return config('responsecache.enabled', true);
    }

    public function cacheRequestUntil(Request $request): DateTime
    {
        $lifetime = config('responsecache.cache_lifetime_in_seconds', 60 * 60 * 24);
        
        return new DateTime("+{$lifetime} seconds");
    }
}

