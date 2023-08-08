<?php

namespace Moharamiamir\codegen\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Pluralizer;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\text;

abstract class MakeStubCommand extends GeneratorCommand
{

    public array $fields;

    protected string $modelName;

    public function handle()
    {
        $this->name = text('Enter Your Model');
        while (confirm(
            label: 'Do you want add field?',
        )) {
            $this->fields[] = text('Enter Your Field', 'E.g title');
        }

        $this->modelName = $this->getSingularClassName($this->name);

        $path = $this->getDestinationPath();
        $this->makeDirectory($path);
        $contents = $this->getContent();
        $this->writeFile($path, $contents);
    }

    protected function writeFile($path, $contents)
    {
        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            return "File : {$path} created";
        } else {
            return "File : {$path} already exits";
        }
    }

    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }

    public function getDestinationPath()
    {
        return $this->path;
    }

    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('{{ ' . $search . ' }}', $replace, $contents);
        }
        return $contents;
    }

    public function getRootStubPath()
    {
        $theme = 'custom';
        return dirname(__DIR__, 2) . '/stubs/' . $theme . DIRECTORY_SEPARATOR;

    }

    public function getStubPath()
    {
        return $this->getRootStubPath() . $this->stub_name;
    }

    private function fillableVariable()
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