<?php
namespace PDJohn\AllClear;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use PDJohn\AllClear\Commands\AllClearCommand;

class AllClearServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton('all:clear', function ($app) {
            return new AllClearCommand();
        });
    }
}
