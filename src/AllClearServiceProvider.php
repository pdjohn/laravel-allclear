<?php
namespace PDJohn\AllClear;

use Illuminate\Support\ServiceProvider;
use PDJohn\AllClear\Commands\AllClearCommand;

class AllClearServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AllClearCommand::class,
            ]);
        }
    }

    public function register()
    {

    }
}
