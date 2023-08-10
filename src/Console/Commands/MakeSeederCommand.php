<?php

namespace Moharamiamir\codegen\Console\Commands;

class MakeSeederCommand extends MakeStubCommand
{
    protected string $path = 'database/seeders';
    protected string $nameSpace= 'Database\Seeders';
    protected string $suffixFilename = 'Seeder';
    protected string $stub_name = 'seeder.stub';


    public function getDestinationPath(): string
    {
        return parent::getDestinationPath() . DIRECTORY_SEPARATOR .  $this->modelName . $this->suffixFilename .'.php';
    }

    protected function getStub(): string
    {
        return $this->getRootStubPath() . $this->stub_name;
    }

    public function getStubVariables(): array
    {
        return [
            'namespace' => $this->nameSpace,
            'class' => $this->getSingularClassName($this->modelName) . $this->suffixFilename,
//            'fillable' => (new getfillable($this->fields))->getOutput(),
        ];
    }
}