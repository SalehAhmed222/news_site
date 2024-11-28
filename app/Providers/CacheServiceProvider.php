<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
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

        // Cache::forget('latest_posts');    for delete Cache


        if (!Cache::has('read_more_posts')) {
            $read_more_posts = Post::select('id', 'name' ,'slug')->latest()->active()->limit(10)->get();
            Cache::remember('read_more_posts', 3600, function () use ($read_more_posts) {
                return $read_more_posts;
            });
        }
        $read_more_posts = Cache::get('read_more_posts');

        //cache for view page
        //cache for latest-posts
        if (!Cache::has('latest_posts')) {
            $latest_posts = Post::select('id', 'name', 'slug')->latest()->active()->limit(3)->get();
            Cache::remember('latest_posts', 3600, function () use ($latest_posts) {
                return $latest_posts;
            });
        }
        $latest_posts = Cache::get('latest_posts');


        //cache for populer posts

        if (!Cache::has('greatest_posts_comment')) {
            $greatest_posts_comment = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->active()
                ->take(3)
                ->get();

            Cache::remember('greatest_posts_comment', 3600, function () use ($greatest_posts_comment) {
                return $greatest_posts_comment;
            });
        }
        $greatest_posts_comment=Cache::get('greatest_posts_comment');

        view()->share([
            'read_more_posts' => $read_more_posts,
            'latest_posts' => $latest_posts,
            'greatest_posts_comment' => $greatest_posts_comment,
        ]);
    }
}
