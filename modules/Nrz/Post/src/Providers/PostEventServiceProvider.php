<?php

namespace Nrz\Post\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Nrz\Post\Subscribers\PostSubscriber;

class PostEventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        PostSubscriber::class
    ];
}
