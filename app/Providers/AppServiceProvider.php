<?php

namespace App\Providers;

use App\Repositories\DoctrineScientistRepository;
use Illuminate\Support\ServiceProvider;
use Doctrine\ORM\Mapping\ClassMetadata;
use App\Repositories\ScientistRepository;
use App\Repositories\DoctrineTheoryRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\ScientistRepository::class, function($app) {
            return new DoctrineScientistRepository(
                $app['em'],
                new ClassMetaData(\App\Scientist::class)
            );
        });

        $this->app->bind(\App\Repositories\TheoryRepository::class, function($app) {
            return new DoctrineTheoryRepository(
                $app['em'],
                new ClassMetaData(\App\Theory::class)
            );
        });
    }
}
