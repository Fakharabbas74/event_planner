<?php

namespace App\Providers;

use App\Interface\EventInterface;
use App\Repository\EventRepository;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(EventInterface::class, EventRepository::class);

    }
}
