<?php

namespace Moharamiamir\codegen\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\text;

abstract class MakeStubCommand extends GeneratorCommand
{

    public array $fields =[];

    protected string $modelName;

    public function __construct(Filesystem $files, $name, $fields)
    {
        parent::__construct($files);
        $this->name = $name;
        $this->fields = $fields;
        $this->modelName = $this->getSingularClassName($this->name);
    }

    public function handle(): void
    {
        $path = $this->getDestinationPath();
        $this->makeDirectory($path);
        $contents = $this->getContent();
        $this->writeFile($path, $contents);
        $this->afterHandle();
    }


    public function afterHandle()
    {
        
    }


    protected function getContent(): array|bool|string
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    protected function writeFile($path, $contents): string
    {
        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            return "File : {$path} created";
        } else {
            return "File : {$path} already exits";
        }
    }

    public function getSingularClassName($name): string
    {
        return ucwords(Pluralizer::singular($name));
    }

    public function getTableName($name): string
    {
        return strtolower(Pluralizer::plural($name));
    }

    public function getDestinationPath()
    {
        return $this->path;
    }

    public function getStubContents($stub, $stubVariables = []): array|bool|string
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('{{ ' . $search . ' }}', $replace, $contents);
        }
        return $contents;
    }

    public function getRootStubPath(): string
    {
        $theme = 'custom';
        return dirname(__DIR__, 2) . '/stubs/' . $theme . DIRECTORY_SEPARATOR;
    }

    public function getStubPath(): string
    {
        return $this->getRootStubPath() . $this->stub_name;
    }

    private function fillableVariable(): array
    {
        $content ='';
        foreach ($this->fields as $key => $field) {
            $content .= "'" . $field . "',";
            if ($key !== count($this->fields) - 1) {
                $content .= "\n\t\t";
            }
        }

        return [
            'fill' => $content,
        ];
    }
}