<?php

namespace Moharamiamir\codegen\Console\Commands;

use App\Http\Controllers\Controller;

class MakeRouteCommand extends MakeStubCommand
{
    protected string $path = 'app/Exceptions/Handler.php';
    protected string $suffixFilename = '';
    protected string $stub_name = '';
    private string|false $contents;


    protected function getStub(): string
    {
        return $this->getRootStubPath() . $this->stub_name;
    }

    protected function getContent(): array|bool|string
    {
        $this->contents = file_get_contents($this->path);
        $this->addUse();
        $this->addRoute();
        return $this->contents;
    }

    public function handle(): void
    {
        $path = $this->getDestinationPath();
        $this->makeDirectory($path);
        $contents = $this->getContent();
        $this->addFile($path, $contents);
        $this->afterHandle();
    }

}