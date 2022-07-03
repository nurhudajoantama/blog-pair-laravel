<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

        // Authorize blog posts for authenticated users
        Gate::define('update-blog', function (User $user, Blog $blog) {
            return $user->id === $blog->user_id;
        });
    }
}
