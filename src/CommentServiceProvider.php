<?php

namespace Jncinet\LaravelComment;

use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../migrations/');
        }

        $this->mergeConfigFrom(
            __DIR__ . '/../config/comment.php',
            'comment'
        );

        $this->publishes([
            __DIR__ . '/../config/comment.php' => config_path('comment.php'),
            __DIR__ . '/../migrations/' => database_path('migrations'),
        ]);
    }
}