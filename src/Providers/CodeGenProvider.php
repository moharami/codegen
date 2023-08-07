<?php


namespace Moharamiamir\codegen\Providers;

use Illuminate\Support\ServiceProvider;

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
    }
}
