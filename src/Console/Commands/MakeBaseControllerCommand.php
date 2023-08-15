<?php

namespace Moharamiamir\codegen\Console\Commands;

class MakeBaseControllerCommand extends MakeStubCommand
{
    protected string $path = 'app/Http/Controllers/Api/BaseController.php';
    protected string $suffixFilename = '';
    protected string $stub_name = 'BaseController.stub';
    private string|false $contents;


    protected function getStub(): string
    {
        return $this->getRootStubPath() . $this->stub_name;
    }

    public function getStubVariables()
    {
        return [];
    }

}