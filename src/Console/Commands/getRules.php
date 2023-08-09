<?php

namespace Moharamiamir\codegen\Console\Commands;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class getRules extends getPart
{


    protected string $stub_name = 'fillable.stub';


    protected function output()
    {
        $output = '';
        foreach ($this->input as $input) {
            $output .= $this->makeRule($input);
        }
        $remove =  "\n\t\t\t";
        $output = substr($output,0,strlen($output) - strlen($remove));
        $this->output = $output;

    }

    private function makeRule(mixed $input)
    {
        $field = array_keys($input)[0];
        $type = array_values($input)[0];

        return $this->toString([$field => $this->getValidation($field, $type)]);
    }

    /**
     * @param $field
     * @param string $type
     * @return string
     */
    protected function getValidation($field, string $type): string
    {
        $validation = multiselect("Validation for $field",
            $this->validateBaseOnType($type)
        );

        if (in_array('min', $validation)) {
            $size = text("min size:$field ", 'E.g 5');
            $validation = $this->replace('min', $size, $validation);
        }

        if (in_array('max', $validation)) {
            $size = text("max size:$field ", 'E.g 255');
            $validation = $this->replace('max', $size, $validation);
        }
        return implode('|', $validation);
    }

    private function validateBaseOnType(string $type): array
    {
        $validationRules = [
            'string' => ['required', 'string', 'max', 'min'],
            'number' => ['required', 'numeric', 'integer'],
            'date' => [],
            'file' => [],
            'boolean' => [],
        ];

        if (array_key_exists($type, $validationRules)) {
            return $validationRules[$type];
        }
    }

    private function replace(string $string, string $size, array $validation)
    {
        $key = array_search($string, $validation);
        $validation[$key] = $string . ':' . $size;
        return $validation;
    }

    private function toString(array $output): string
    {
        $out = '';
        foreach ($output as $key => $item) {
            $out .= '"' . $key . '"' . ' => ' . '"' . $item . '"' . ",\n\t\t\t";
        }
        return $out;
    }

    protected function getReplacedContet(): array|bool|string
    {
        $contents = $this->stubContent;

        foreach ($this->getStubVariables() as $search => $replace) {
            $contents = str_replace('{{ ' . $search . ' }}', $replace, $contents);
        }
        return $contents;
    }

    private function commonField(mixed $input)
    {
        $commonString = ['name', 'title'];
        if (in_array($input, $commonString)) {
            return [$input => 'string|nullable'];
        }
    }
}