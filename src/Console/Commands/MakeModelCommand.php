<?php

namespace Moharamiamir\codegen\Console\Commands;


class MakeModelCommand extends MakeStubCommand
{

    protected string $path = 'app/Models';
    protected string $stub_name = 'model.stub';


    public function getDestinationPath(): string
    {
        return parent::getDestinationPath() . DIRECTORY_SEPARATOR .  $this->modelName . '.php';
    }

    protected function getStub(): string
    {
        return $this->getRootStubPath() . $this->stub_name;
    }

    protected function getContent(): array|bool|string
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    public function getStubVariables(): array
    {
        return [
            'namespace' => 'App\\Models',
            'class' => $this->getSingularClassName($this->modelName),
            'fillable' => $this->fillable(),
        ];
    }

    private function fillable()
    {
        if ($this->fields){
            return $this->getStubContents($this->getStubFillabePath(), $this->fillableVariable());
        }
    }

    public function getStubFillabePath(): string
    {
        return $this->getRootStubPath() . $this->fillable_name;
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