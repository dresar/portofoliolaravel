<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\ResponseCache\Events\ClearedResponseCache;
use Spatie\ResponseCache\Events\ClearingResponseCache;

class ResponseCacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Clear cache ketika ada perubahan di models
        $this->clearCacheOnModelChanges();
    }

    protected function clearCacheOnModelChanges(): void
    {
        $models = [
            \App\Models\Project::class,
            \App\Models\Service::class,
            \App\Models\Skill::class,
            \App\Models\Experience::class,
            \App\Models\Post::class,
        ];

        foreach ($models as $model) {
            $model::saved(function () {
                \Spatie\ResponseCache\Facades\ResponseCache::clear();
            });

            $model::deleted(function () {
                \Spatie\ResponseCache\Facades\ResponseCache::clear();
            });
        }
    }
}

