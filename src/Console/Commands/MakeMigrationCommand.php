<?php

namespace Moharamiamir\codegen\Console\Commands;


class MakeMigrationCommand extends MakeStubCommand
{


    protected string $path = 'database/migrations';
    protected string $suffixFilename = '';
    protected string $prefixFilename = '';
    protected string $stub_name = 'migration.create.stub';


    public function getDestinationPath(): string
    {
        $date = date("Y_m_d_His"); // Get the current date and time in the format 2023_08_09_121610
        return   parent::getDestinationPath() . DIRECTORY_SEPARATOR . $date .  '_create_' . strtolower($this->modelName) . $this->suffixFilename .'_table.php';
    }

    protected function getStub(): string
    {
        return $this->getRootStubPath() . $this->stub_name;
    }

    public function getStubVariables(): array
    {
        return [
            'table'=> $this->getTableName($this->modelName),
            'fields' => (new Column($this->fields))->get(),
        ];
    }


}