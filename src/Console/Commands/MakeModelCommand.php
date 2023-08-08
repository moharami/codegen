<?php

namespace Moharamiamir\codegen\Console\Commands;


class MakeModelCommand extends MakeStubCommand
{

    protected string $path = 'app/Models';
    protected string $stub_name = 'model.stub';


    public function getDestinationPath(): string
    {
        return parent::getDestinationPath() . DIRECTORY_SEPARATOR .  $this->modelName . '.php';
    }

    protected function getStub(): string
    {
        return $this->getRootStubPath() . $this->stub_name;
    }



    public function getStubVariables(): array
    {
        return [
            'namespace' => 'App\\Models',
            'class' => $this->getSingularClassName($this->modelName),
            'fillable' => (new getfillable($this->fields))->getOutput(),
        ];
    }
}