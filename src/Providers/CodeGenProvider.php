<?php


namespace Moharamiamir\codegen\Providers;

use Illuminate\Support\ServiceProvider;
use Moharamiamir\codegen\Console\Commands\make;

class CodeGenProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->commands([
            make::class
        ]);
    }
}
