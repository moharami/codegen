<?php

namespace Moharamiamir\codegen\Console\Commands;

class getPart
{

    protected string $stub;
    protected string|false $stubContent;
    protected string $output = '';
    private $content;
    protected mixed $input;


    public function __construct($input)
    {
        $this->input = $input;
        $this->stub = $this->getRootStubPath() . $this->stub_name;
        $this->stubContent = file_get_contents($this->stub);
        $this->output();
    }

    public function getRootStubPath()
    {
        $theme = 'custom';
        return dirname(__DIR__, 2) . '/stubs/' . $theme . DIRECTORY_SEPARATOR;
    }

    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }

}