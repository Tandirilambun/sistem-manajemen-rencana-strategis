<?php

namespace App\Providers;

use App\Models\Users;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Gate::define('direktur', function(Users $users){
            return $users -> role === 'DIREKTUR';
        });
        Gate::define('wakil-direktur', function(Users $users){
            return $users -> role === 'WAKIL DIREKTUR';
        });
        Gate::define('kep-dept', function(Users $users){
            return $users -> role === 'KEPALA DEPARTEMEN';
        });
        Gate::define('kep-unit', function(Users $users){
            return $users -> role === 'KEPALA UNIT';
        });
        Gate::define('staff', function(Users $users){
            return $users -> role === 'STAFF';
        });
    }
}
