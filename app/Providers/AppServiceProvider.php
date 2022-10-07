<?php

namespace App\Providers;

use App\Models\Package;
use App\Models\Souvenir;
use App\Models\Ticket;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        if (!defined('ADMIN')) {
            define('ADMIN', config('variables.APP_ADMIN', 'admin'));
        }
        require_once base_path('resources/macros/form.php');

        Relation::morphMap([
            'souvenir' => Souvenir::class,
            'ticket' => Ticket::class,
            'package' => Package::class,

        ]);
    }
}
