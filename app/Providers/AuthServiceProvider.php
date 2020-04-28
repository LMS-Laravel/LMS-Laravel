<?php

namespace App\Providers;

use App\Entities\User;
use Illuminate\Contracts\Hashing\Hasher as HasherContract; // make sure to add this
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // here's the new stuff
        Auth::provider('custom', function ($app) {
            return new CustomAuthServiceProvider($app->make(HasherContract::class), User::class);
        });

        Passport::routes();
    }
}
