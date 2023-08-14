<?php

namespace Moharamiamir\codegen\Console\Commands;

class getResource
{
    protected array $fields;
    protected $output;

    /**
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
        $this->output();
    }

    private function output()
    {
        if (!$this->fields){
            $this->output =  'return parent::toArray($request);';
            return;
        }
        $content = "return [\n\t\t\t";
        $content .= "'id' => " . '$this->id' .  ",\n\t\t\t";

        foreach ($this->fields as $key => $field) {
            $content .= "'" . $key . "'" . ' => $this->' . $key  .",\n\t\t\t";
        }
        $content = substr($content,0,-1);
        $content .= '];';

        $this->output = $content;
    }

    public function getOutput()
    {
        return $this->output;
    }


}