<?php

namespace Moharamiamir\codegen\Console\Commands;

class Column extends makeArray
{
    public function get()
    {
        $content = '';
        foreach ($this->inputs as $key => $input){
            $type = $input['type'];
            $content .= '$table->' . "$type" . '("' ."$key" .'")';
            foreach ($input['modifier'] as $key1 =>$modifier){
                $content .= $this->makeModifier($modifier);
            }
            $content .= ";\n\t\t\t";
        }
        $remove = "\n\t\t\t";
        return substr($content, 0, strlen($content) - strlen($remove));
        
    }

    private function makeModifier(mixed $modifier)
    {
        switch ($modifier){
            case 'nullable':
                $output = "->nullable()";
                break;
            case 'comment':
                $output = "->comment('')";
                break;
        }
        return $output;
    }
}