<?php

namespace Moharamiamir\codegen\Console\Commands;

class getFaker extends makeArray
{

    public function get()
    {
        $content = '';
        foreach ($this->inputs as $key => $input) {
            $type = $input['type'];
            $content .= "'$key' => "  . '$this->faker->' .$this->makeFakerBaseType($type). ',' ;
            $content .= "\n\t\t\t";
        }
        $remove = "\n\t\t\t";
        return substr($content, 0, strlen($content) - strlen($remove));

    }


    private function makeFakerBaseType(mixed $type)
    {
        switch ($type) {
            case 'string':
                $output = "words(5, true)";
                break;
            case 'integer':
                $output = "randomNumber(2)";
                break;
        }
        return $output;
    }
}