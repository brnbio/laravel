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

            case 'int':
            case 'integer':
            case 'tinyint':
            case 'smallint':
            case 'mediumint':
            case 'longint':
                return 'int';
                break;

            case 'double':
            case 'float':
                return 'float';
                break;

            case 'date':
            case 'datetime':
            case 'time':
            case 'timestamp':
                return 'Carbon';
                break;

            case 'boolean':
                return 'bool';
                break;

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

        // -- faker by column name
        switch ($columnName) {

            case 'email':
                return $column->unique ? '$faker->unique()->safeEmail' : '$faker->email';
                break;

            case 'firstname':
                return '$faker->firstName';
                break;

            case 'lastname':
                return '$faker->lastName';
                break;

        }

        // -- foreign key faking
        if (strpos($column->name, '_id')) {
            return '$faker->numberBetween(1, ' . GenerateCommand::ENTITY_COUNT . ')';
        }

        // -- faker by column type
        switch ($column->type) {

            case 'boolean':
                return '$faker->boolean';
                break;

            case 'int':
            case 'tinyint':
            case 'integer':
                return '$faker->randomDigit';
                break;

            case 'tinytext':
            case 'text':
            case 'mediumtext':
            case 'longtext':
                return '$faker->text';
                break;

            case 'double':
            case 'float':
                return '$faker->randomFloat(4, 0, 1000)';
                break;

            case 'date':
            case 'datetime':
            case 'time':
            case 'timestamp':
                return 'new Carbon($faker->date())';
                break;

        }

        return '$faker->word';
    }
}