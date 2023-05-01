<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function(user $user){
            return $user->roles_id == 1;
        });
        Gate::define('isGuru', function(user $user){
            return $user->roles_id == 2;
        });
        Gate::define('isWalikelas', function(user $user){
            return $user->roles_id == 3;
        });
        Gate::define('isUser', function(user $user){
            return $user->roles_id == 4;
        });

        //
    }
}
