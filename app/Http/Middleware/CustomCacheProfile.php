<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Spatie\ResponseCache\CacheProfiles\BaseCacheProfile;
use Symfony\Component\HttpFoundation\Response;

class CustomCacheProfile extends BaseCacheProfile
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

        // Jangan cache AJAX requests
        if ($request->ajax()) {
            return false;
        }

        // Jangan cache jika running di console
        if ($this->isRunningInConsole()) {
            return false;
        }

        // Hanya cache GET requests
        return $request->isMethod('GET');
    }

    public function shouldCacheResponse(Response $response): bool
    {
        if (! $this->hasCacheableResponseCode($response)) {
            return false;
        }

        if (! $this->hasCacheableContentType($response)) {
            return false;
        }

        return true;
    }
}

