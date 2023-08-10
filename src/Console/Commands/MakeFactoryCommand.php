<?php

namespace Moharamiamir\codegen\Console\Commands;


class MakeFactoryCommand extends MakeStubCommand
{

    protected string $nameSpace= 'Database\Factories';

    protected string $path = 'database/factories';
    protected string $suffixFilename = 'Factory';
    protected string $stub_name = 'factory.stub';


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
            'factoryNamespace' => $this->nameSpace,
            'factory' => $this->getSingularClassName($this->modelName),
            'namespacedModel'=> "App\\Models\\" . $this->getSingularClassName($this->modelName),
//            'fillable' => (new getfillable($this->fields))->getOutput(),
        ];
    }

}