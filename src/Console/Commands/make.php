<?php

namespace Moharamiamir\codegen\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;
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

            $default = $this->setDefault($field);
            $type = select('Type field',
                ['boolean', 'bigInteger', 'integer', 'smallInteger', 'unsignedBigInteger', 'unsignedInteger', 'unsignedSmallInteger', 'decimal', 'double', 'string', 'longText', 'mediumText', 'text', 'tinyText', 'char', 'date', 'dateTime', 'dateTimeTz', 'time'],
                $default,
            );

            $integer_modifier = ['nullable', 'unsigned'];
            $string_modifier = ['nullable', 'comment'];
            $type_modifier = $type . '_modifier';
            $modifier = multiselect('additional data', $$type_modifier);

            $this->fields[$field] = [
                'type' => $type,
                'modifier' => $modifier
            ];
        }


        $files = app()->make(Filesystem::class);
        $commands = [
//            new MakeMigrationCommand($files, $this->model, $this->fields),
//            new MakeModelCommand($files, $this->model, $this->fields),
//            new MakeControllerCommand($files, $this->model, $this->fields),
//            new MakeSaveRequestCommand($files, $this->model, $this->fields),
//            new MakeUpdateRequestCommand($files, $this->model, $this->fields),
//            new MakeResourceCommand($files, $this->model, $this->fields),
//            new MakeFactoryCommand($files, $this->model, $this->fields),
//            new MakeSeederCommand($files, $this->model, $this->fields),
//            new MakeRouteCommand($files, $this->model, $this->fields),
            new MakeExceptionCommand($files, $this->model, $this->fields),
        ];

        foreach ($commands as $command) {
            $command->handle();
        }
        $this->info('done');
    }

    private function setDefault(string $fieldName)
    {
        if (strpos($fieldName, 'is_') === 0) {
            return 'boolean';
        } elseif (strpos($fieldName, '_date') !== false || strpos($fieldName, '_at') !== false) {
            return 'date';
        } else {
            return 'string';
        }
    }


}
