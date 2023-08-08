<?php

namespace Moharamiamir\codegen\Console\Commands;

use App\Console\Commands\MakeStubCommand;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\text;

class MakeFactoryCommand extends MakeStubCommand
{

    public function __construct()
    {
        $fields = [];
        $name = text('What should the model be named?');
        while (confirm(
            label: 'Do you want add field?',
        )) {
            $fields[] = text('Enter Your Field', 'E.g title');
        }
    }

}