<?php
namespace App\Authentication;
use Auth;
use App\Authentication\UserProvider;
use Illuminate\Support\ServiceProvider;

class CustomAuthProvider extends ServiceProvider {

    
    
    /**
     * https://laracasts.com/discuss/channels/laravel/replacing-the-laravel-authentication-with-a-custom-authentication
     */
    
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
//        $this->registerPolicies();

        Auth::provider('custom', function ($app, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\UserProvider...

            return new CustomUserProvider();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
