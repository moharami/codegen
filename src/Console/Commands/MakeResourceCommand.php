<?php

namespace Moharamiamir\codegen\Console\Commands;

class MakeResourceCommand extends MakeStubCommand
{


    protected string $path = 'app/Http/Resources/V1';
    protected string $suffixFilename = 'ShowResource';
    protected string $stub_name = 'resource.stub';

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
            'class' => $this->getSingularClassName($this->modelName) .$this->suffixFilename,
//            'fillable' => (new getfillable($this->fields))->getOutput(),
        ];
    }
}