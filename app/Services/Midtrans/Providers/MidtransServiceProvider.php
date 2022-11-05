<?php
namespace App\Services\Midtrans\Providers;
use Illuminate\Support\ServiceProvider;
use App\Services\Midtrans\Midtrans;
class MidtransServiceProvider extends ServiceProvider {

    /** @return string */
    public function getConfigPath() {
        return __DIR__ . '/../config/midtrans.php';
    }

    public function boot() {
        $this->publishes([
            $this->getConfigPath() => config_path('midtrans.php'),
        ], 'config');

        $this->app->singleton('midtrans', function ($app) {
            return new Midtrans;
        });

        Midtrans::registerMidtransConfig();
    }

    public function register() {
        $this->mergeConfigFrom(
            $this->getConfigPath(),
            'midtrans'
        );
    }

}
