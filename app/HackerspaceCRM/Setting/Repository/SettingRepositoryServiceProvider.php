<?php

namespace HackerspaceCRM\Setting\Repository;

use View;
use Cache;
use HackerspaceCRM\Setting\Setting;
use Illuminate\Support\ServiceProvider;

class SettingRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Setting::updating(function ($setting) {
            $this->clearCache($setting->key);
        });
        Setting::creating(function ($setting) {
            $this->clearCache($setting->key);
        });
        Setting::deleting(function ($setting) {
            $this->clearCache($setting->key);
        });
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        // $this->app->bind(SettingRepositoryInterface::class, EloquentSettingRepository::class);
        $this->app->singleton(SettingRepositoryInterface::class, function () {
            return new CacheableEloquentSettingRepository(
                new EloquentSettingRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache($key)
    {
        Cache::tags('settings')->flush();
        // Cache::forget('setting.all');
        // Cache::forget('setting.byKey.'.$key);
    }
}
