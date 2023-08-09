<?php

namespace Moharamiamir\codegen\Console\Commands;

class MakeUpdateRequestCommand extends MakeStubCommand
{

    protected string $path = 'app/Http/Requests';
    protected string $namespace = 'App\\Http\\Requests';
    protected string $suffixFilename = 'UpdateRequest';
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
        getRules::setInput($this->fields);
        $rules = getRules::getInstance();
        $output = $rules->getOutput();

        return [
            'class' => $this->getSingularClassName($this->modelName) . $this->suffixFilename,
            'namespace' => $this->namespace,
            'rules' => $output,
        ];
    }
}