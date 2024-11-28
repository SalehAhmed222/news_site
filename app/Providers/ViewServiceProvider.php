<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\RelatedNewsSites;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        //share for RealtedNewsSite
        $relatedNewsSites = RelatedNewsSites::select('id','name', 'url')->get();

        //share fro CategoryPosts
        $categoriesPosts = Category::active()->select('id','slug', 'name')->get();

        view()->share([

            'relatedNewsSites' => $relatedNewsSites,
            'categoriesPosts' => $categoriesPosts,
        ]);
    }
}
