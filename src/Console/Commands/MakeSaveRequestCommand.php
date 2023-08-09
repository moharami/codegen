<?php

namespace Moharamiamir\codegen\Console\Commands;

class MakeSaveRequestCommand extends MakeStubCommand
{


    private static string $out;
    protected string $path = 'app/Http/Requests';
    protected string $namespace = 'App\\Http\\Requests';
    protected string $suffixFilename = 'StoreRequest';
    protected string $stub_name = 'request.stub';


    public function getDestinationPath(): string
    {
        return parent::getDestinationPath() . DIRECTORY_SEPARATOR . $this->modelName . $this->suffixFilename . '.php';
    }

    public function getStubVariables(): array
    {
        $rule = getRules::getInstance();
        $rule::setInput($this->fields);
        $rule::Output();

        return [
            'class' => $this->getSingularClassName($this->modelName) . $this->suffixFilename,
            'namespace' => $this->namespace,
            'rules' => $rule::getOutput(),
        ];
    }

    protected function getStub(): string
    {
        return $this->getRootStubPath() . $this->stub_name;
    }
}