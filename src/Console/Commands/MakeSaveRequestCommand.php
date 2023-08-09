<?php

namespace Moharamiamir\codegen\Console\Commands;

class MakeSaveRequestCommand extends MakeStubCommand
{

    protected string $path = 'app/Http/Requests';
    protected string $namespace = 'App\\Http\\Requests';
    protected string $suffixFilename = 'StoreRequest';
    protected string $stub_name = 'request.stub';


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
            'class' => $this->getSingularClassName($this->modelName) . $this->suffixFilename,
            'namespace' => $this->namespace,
            'rules' => (new getRules($this->fields))->getOutput(),
        ];
    }
}