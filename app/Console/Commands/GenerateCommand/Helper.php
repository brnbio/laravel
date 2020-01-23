<?php

declare(strict_types=1);

namespace App\Console\Commands\GenerateCommand;

use App\Console\Commands\GenerateCommand;
use App\Support\Str;
use Dbml\Dbml\Model\Table\Column;

class Helper
{
    /**
     * @param string $tableName
     * @return array
     */
    public static function getClassInfo(string $tableName): array
    {
        $parts = explode('_', $tableName);
        $model = Str::singular(ucfirst(array_pop($parts)));
        $namespace = ucwords(implode('\\', $parts), '\\');

        return [
            'plugin' => ucfirst($parts[0]),
            'namespace' => $namespace,
            'model' => $model,
        ];
    }

    /**
     * @param string $mysqlDataType
     * @return string
     */
    public static function getPhpDataType(string $mysqlDataType): string
    {
        switch ($mysqlDataType) {
            case 'integer':
            case 'tinyint':
                return 'int';
            case 'date':
            case 'datetime':
            case 'time':
                return 'Carbon';
        }

        return 'string';
    }

    /**
     * @param Column $column
     * @return string
     */
    public static function getFakerType(Column $column): string
    {
        $columnName = str_replace('_', '', $column->name);

        switch ($columnName) {
            case 'email':
                return $column->unique ? 'unique()->safeEmail' : 'email';
                break;
            case 'firstname':
                return 'firstName';
                break;
            case 'lastname':
                return 'lastName';
                break;
        }

        if (strpos($column->name, '_id')) {
            return 'numberBetween(0, ' . (GenerateCommand::ENTITY_COUNT - 1) . ')';
        }

        switch ($column->type) {
            case 'int':
            case 'tinyint':
            case 'integer':
                return 'randomDigit';
                break;
            case 'text':
                return 'words';
                break;
            case 'float':
                return 'randomFloat(4)';
                break;
            case 'date':
                return 'date()';
                break;
        }

        return 'word';
    }
}