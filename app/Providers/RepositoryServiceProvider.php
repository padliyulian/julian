<?php

namespace App\Providers;

use App\Repositories\AuthInterface;
use App\Repositories\UserInterface;
use App\Repositories\AuthRepository;
use App\Repositories\SkillInterface;
use App\Repositories\UserRepository;
use App\Repositories\SkillRepository;
use App\Repositories\ActivityInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ActivityRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AuthInterface::class,
            AuthRepository::class
        );

        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            SkillInterface::class,
            SkillRepository::class
        );

        $this->app->bind(
            ActivityInterface::class,
            ActivityRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
