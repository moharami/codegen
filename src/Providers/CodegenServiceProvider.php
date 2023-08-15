<?php


namespace Moharamiamir\codegen\Providers;

use Illuminate\Support\ServiceProvider;
use Moharamiamir\codegen\Console\Commands\make;

class CodegenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Registering package commands.
        $this->commands([
            make::class
        ]);
    }
}
