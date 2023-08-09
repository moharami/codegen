<?php

namespace Moharamiamir\codegen\Console\Commands;

class Column
{

    public function __construct($input)
    {
        $this->inputs = $input;
    }

    public function get()
    {
        $content = '';
        foreach ($this->inputs as $key => $input){
            $content .= '$table->' . "$input" . '("' ."$key" .'");' ."\n\t\t\t";
        }
        $remove = "\n\t\t\t";
        return substr($content, 0, strlen($content) - strlen($remove));
        
    }
}