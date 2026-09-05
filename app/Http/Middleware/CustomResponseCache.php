<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\ResponseCache\Facades\ResponseCache;
use Symfony\Component\HttpFoundation\Response;

class CustomResponseCache
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip cache untuk admin panel
        if ($request->is('admin*')) {
            return $next($request);
        }

        // Skip cache untuk livewire
        if ($request->is('livewire/*')) {
            return $next($request);
        }

        // Gunakan response cache untuk frontend
        return ResponseCache::getResponseFor($request) ?? $next($request);
    }
}

