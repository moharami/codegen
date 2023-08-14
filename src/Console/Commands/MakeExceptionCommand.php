<?php

namespace Moharamiamir\codegen\Console\Commands;


class MakeExceptionCommand extends MakeStubCommand
{
    protected string $path = 'app/Exceptions';
    protected string $nameSpace = '';
    protected string $suffixFilename = '';
    protected string $stub_name = 'exception.stub';


    public function getDestinationPath(): string
    {
        return parent::getDestinationPath() . DIRECTORY_SEPARATOR . 'Handler' . '.php';
    }

    public function getStubVariables(): array
    {
        return [];
    }

    public function afterHandle()
    {

    }

    protected function getStub(): string
    {
        return $this->getRootStubPath() . $this->stub_name;
    }



    protected function writeFile($path, $contents): string
    {
        if (!$this->editedBefore()) {
            $this->files->put($path, $contents);
            return "File : {$path} created";
        } else {
            return "File : {$path} already exits";
        }
    }

    private function editedBefore(): bool
    {
        $file_contents = $this->files->get($this->getDestinationPath());
        $position = strpos($file_contents, '404');

        if ($position !== false) {
            return true;
        } else {
            return false;
        }
    }
}