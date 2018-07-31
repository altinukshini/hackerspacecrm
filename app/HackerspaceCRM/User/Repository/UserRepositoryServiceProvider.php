<?php

namespace HackerspaceCRM\User\Repository;

use Illuminate\Support\ServiceProvider;

class UserRepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('HackerspaceCRM\User\Repository\UserRepositoryInterface', function ($app) {
            return new UserRepository();
        });
    }
}
