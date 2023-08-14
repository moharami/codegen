<?php

namespace Moharamiamir\codegen\Console\Commands;

use App\Http\Controllers\Controller;

class MakeRouteCommand extends MakeStubCommand
{
    protected string $path = 'routes/api.php';
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


    private function addFile($path, bool|array|string $contents)
    {
        $this->files->put($path, $contents);
    }

    private function addUse()
    {
        $lines = explode("\n", $this->contents);
        $lastUseIndex = $this->lastLineOfUse('use ');
        $lineToInsert = 'use App\\Http\\Controllers\\Api\\V1\\' . $this->modelName . 'Controller;';
        array_splice($lines, $lastUseIndex + 1, 0, $lineToInsert);
        $this->contents = implode("\n", $lines);
    }

    private function lastLineOfUse($search)
    {
        $lines = explode("\n", $this->contents);

        $lastUseIndex = 0;
        foreach ($lines as $index => $line) {
            if (strpos($line, $search) === 0) {
                $lastUseIndex = $index;
            }
        }
        return $lastUseIndex;
    }

    private function addRoute()
    {
        $lower = $this->routeName;
        $line = "Route::resource('$lower'," . "$this->modelName" .'Controller::class);';
        $this->contents .= "\n" . $line;
    }
}