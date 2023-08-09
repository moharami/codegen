<?php

namespace Moharamiamir\codegen\Console\Commands;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class getRules
{

    private static $instance = null;
    private static $input;
    private static  string $output;

    private function __construct()
    {
        // Private constructor to prevent direct instantiation
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return string
     */
    public static function getOutput(): string
    {
        return self::$output;
    }

    public static function Output()
    {
        $output = '';
        foreach (self::$input as $input) {
            $output .= self::makeRule($input);
        }
        $remove = "\n\t\t\t";
        $output = substr($output, 0, strlen($output) - strlen($remove));
        self::$output = $output;
    }

    private static function makeRule(mixed $input)
    {
        $field = array_keys($input)[0];
        $type = array_values($input)[0];

        return self::toString([$field => self::getValidation($field, $type)]);
    }

    /**
     * @param $field
     * @param string $type
     * @return string
     */
    protected static function getValidation($field, string $type): string
    {
        $validation = multiselect("Validation for $field", self::validateBaseOnType($type));

        if (in_array('min', $validation)) {
            $size = text("min size:$field ", 'E.g 5');
            $validation = self::replace('min', $size, $validation);
        }

        if (in_array('max', $validation)) {
            $size = text("max size:$field ", 'E.g 255');
            $validation = self::replace('max', $size, $validation);
        }
        return implode('|', $validation);
    }

    private static function validateBaseOnType(string $type): array
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

        return [];
    }

    private static function replace(string $string, string $size, array $validation)
    {
        $key = array_search($string, $validation);
        $validation[$key] = $string . ':' . $size;
        return $validation;
    }

    private static function toString(array $output): string
    {
        $out = '';
        foreach ($output as $key => $item) {
            $out .= '"' . $key . '"' . ' => ' . '"' . $item . '"' . ",\n\t\t\t";
        }
        return $out;
    }

    /**
     * @param mixed $input
     */
    public static function setInput(mixed $input): void
    {
        self::$input = $input;
    }
}