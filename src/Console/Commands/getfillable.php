<?php

namespace Moharamiamir\codegen\Console\Commands;

class getfillable extends getPart
{
    protected string $stub_name = 'fillable.stub';

    protected function output()
    {
        if ($this->input) {
            $this->output = $this->getReplacedContet();
        }
    }

    /**
     * @param array|bool|string $contents
     * @return array|bool|string|string[]
     */
    protected function getReplacedContet(): array|bool|string
    {
        $contents = $this->stubContent;

        foreach ($this->getStubVariables() as $search => $replace) {
            $contents = str_replace('{{ ' . $search . ' }}', $replace, $contents);
        }
        return $contents;
    }

    public function getStubVariables(): array
    {

        return [
            'fill' => $this->fillableVariable()
        ];
    }

    private function fillableVariable()
    {
        $content = '';
        foreach ($this->input as $key => $field) {
            $content .= "'" . $field . "',";
            if ($key !== count($this->input) - 1) {
                $content .= "\n\t\t";
            }
        }
        return $content;
    }

}