<?php

namespace Moharamiamir\codegen\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;


class make extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate code';


    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;


    /**
     * Execute the console command.
     */
    public function handle()
    {        $fields = [];

    $files = app()->make(Filesystem::class);
        $commands = [
            new MakeModelCommand($files),
//            new MakeMigrationCommand(),
//            new MakeFactoryCommand(),
        ];

        foreach ($commands as $command) {
            $command->handle();
        }

        $this->info('done');
    }

}
