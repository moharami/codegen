<?php

namespace Moharamiamir\codegen\Console\Commands;

class MakeCollectionCommand
{

    protected string $path = 'app/Models';
    protected string $suffixFilename = '';
    protected string $stub_name = 'model.stub';


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
            'namespace' => 'App\\Models',
            'class' => $this->getSingularClassName($this->modelName),
            'fillable' => (new getfillable($this->fields))->getOutput(),
        ];
    }
}