<?php

namespace App\Providers;

use App\Http\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Repositories\Eloquent\UserRepository;
use App\Http\Repositories\Contracts\PostRepositoryInterface;
use App\Http\Repositories\Eloquent\PostRepository;
use App\Http\Repositories\Contracts\CommentRepositoryInterface;
use App\Http\Repositories\Eloquent\CommentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
