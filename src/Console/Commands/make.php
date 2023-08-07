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
    private $modelName;

    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }




    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fields = [];
        $name =  text('What should the model be named?');
        while(confirm(
            label: 'Do you want add field?',

        )){
            $fields[] =  text('Enter Your Field','E.g title');

        }

        $model = new CreateModel($name, $fields);
        $this->info($model->make());
    }



}
