<?php

namespace Moharamiamir\codegen\Console\Commands;

class MakeResourceCollectionCommand extends MakeStubCommand
{
    protected string $path = 'app/Http/Resources/V1';
    protected string $suffixFilename = 'Collection';
    protected string $stub_name = 'collection.stub';

    protected string $nameSpace= 'App\Http\Resources\V1';


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
            'model' => $this->getSingularClassName($this->modelName),
        ];
    }

}