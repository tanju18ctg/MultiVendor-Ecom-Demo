<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        // if (! $this->app->routesAreCached()) {
        Passport::routes();
        // }
        Passport::tokensCan([
            'user' => 'User Type',
            'admin' => 'Admin User Type',
            'seller' => 'Seller User Type',
        ]);

        Passport::setDefaultScope([
            'user'
        ]);


        //use gate to secure seller product edit with own id
        Gate::define('seller-p', function ($user, $product) {
            return $user->id === $product->seller_id;
        });
    }


}
