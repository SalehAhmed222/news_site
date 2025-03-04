<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        ///for permessions in dashboard admins
        $this->registerPolicies();

        foreach (config('authorization.permessions') as $config_permession => $value) {
            Gate::define($config_permession ,function($auth)use($config_permession){
                return $auth->hasAccess($config_permession);
                //hasAccess use in model related to permessions (Admin)
            });
        }


    }
}
