<?php

declare(strict_types=1);

namespace App\Console\Commands\GenerateCommand;

use App\Support\Str;
use Dbml\Dbml\Model\Table\Column;
use Exception;
use Throwable;

/**
 * Class ModelCreator
 * @package App\Console\Commands\GenerateCommand\Model
 */
class ModelCreator
{
    /**
     * @param string $name
     * @param string $tableName
     * @param Column[] $columns
     * @return string
     * @throws Throwable
     */
    public function create(string $name, string $tableName, array $columns): string
    {
        $className = trim(class_basename($name));
        $content = view(
            'stubs.model',
            [
                'className' => $className,
                'namespace' => trim(str_replace('\\' . $className, '', $name)),
                'table'     => $tableName,
                'columns'   => $columns,
            ]
        );

        $filename = app_path(
            str_replace('App' . DIRECTORY_SEPARATOR, '', str_replace('\\', DIRECTORY_SEPARATOR, $name)) . '.php'
        );
        $targetDir = dirname($filename);
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (!file_put_contents($filename, $content->render())) {
            throw new Exception('Can\'t write model file!');
        }

        return $filename;
    }
}