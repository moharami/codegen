<?php

namespace Moharamiamir\codegen\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\text;
use function Laravel\Prompts\select;
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
    protected string $model;
    private array $fields = [];

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->model = text('Enter Your Model');
        while (confirm(
            label: 'Do you want add fields?',
        )) {
            $field = text('Enter Your Field', 'E.g title');
            $type = select('Type Of filed',
                ['string', 'number', 'date', 'file', 'boolean']);

            $this->fields[] = [$field => $type];
        }


        $files = app()->make(Filesystem::class);
        $commands = [
            new MakeModelCommand($files, $this->model, $this->fields),
            new MakeControllerCommand($files, $this->model, $this->fields),
            new MakeSaveRequestCommand($files, $this->model, $this->fields),
            new MakeUpdateRequestCommand($files, $this->model, $this->fields),
//            new MakeFactoryCommand(),
        ];

        foreach ($commands as $command) {
            $command->handle();
        }

        $this->info('done');
    }




}
