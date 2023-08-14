<?php

namespace Moharamiamir\codegen\Console\Commands;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;

class FieldType
{
    public static string $field;


    /**
     * @param string $field
     * @return array
     */
    public static  function get(): array
    {
        $type = select('Type field',
            ['boolean', 'bigInteger', 'integer', 'smallInteger', 'unsignedBigInteger', 'unsignedInteger', 'unsignedSmallInteger', 'decimal', 'double', 'string', 'longText', 'mediumText', 'text', 'tinyText', 'char', 'date', 'dateTime', 'dateTimeTz', 'time'],
            self::setDefault(self::$field),
        );

        $integer_modifier = ['nullable', 'unsigned'];
        $string_modifier = ['nullable', 'comment'];
        $type_modifier = $type . '_modifier';
        $modifier = multiselect('additional data', $$type_modifier);

        $value = [
            'type' => $type,
            'modifier' => $modifier
        ];
        return $value;
    }


    private static function setDefault(string $fieldName)
    {
        switch (true) {
            case (str_starts_with($fieldName, 'is_')):
                return 'boolean';
            case (str_contains($fieldName, '_date') || str_contains($fieldName, '_at')):
                return 'date';
            default:
                return 'string';
        }
    }
}