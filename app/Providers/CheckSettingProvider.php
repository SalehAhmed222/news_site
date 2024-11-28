<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\RelatedNewsSites;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
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
       $getSetting = Setting::firstOr(function(){
            return Setting::create([
                'site_name'=>'news',
                'favicon'=>'default',
                'logo'=>'/imagesfaker/logo.png',
                'facebook'=>'https://www.facebook.com/',
                'instagram'=>'https://www.instagram.com/',
                'twitter'=>'https://www.twitter.com/',
                'youtube'=>'https://www.youtube.com/',
                'street'=>'El Bahr',
                'city'=>'Giza',
                'country'=>'Egypt',
                'email'=>'salehahmedsaeed1234@gmail.com',
                'phone'=>'01125436730',
                'small_desc'=>'test small description to optimize seo for tools search',



            ]);
        });

        //for connect phone with wahtsapp
        $getSetting->whatsapp = 'https://wa.me/'.$getSetting->phone;


        //share for RealtedNewsSite
        $relatedNewsSites =RelatedNewsSites::select('name','url')->get();

        //share fro CategoryPosts
        $categoriesPosts= Category::select('slug','name')->get();

        view()->share([
            'getSetting' =>$getSetting,
            'relatedNewsSites' =>$relatedNewsSites,
            'categoriesPosts' =>$categoriesPosts,
        ]);
    }
}
