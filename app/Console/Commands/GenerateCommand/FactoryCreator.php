<?php

declare(strict_types=1);

namespace App\Console\Commands\GenerateCommand;

use Dbml\Dbml\Model\Table\Column;
use Exception;
use Throwable;

/**
 * Class FactoryCreator
 * @package App\Console\Commands\GenerateCommand
 */
class FactoryCreator
{
    /**
     * @param string $model
     * @param string $namespace
     * @param Column[] $columns
     * @return string
     * @throws Throwable
     */
    public function create(string $model, string $namespace, array $columns): string
    {
        $content = view(
            'stubs.factory',
            [
                'model'          => $model,
                'modelNamespace' => 'App\Models\\' . $namespace . '\\' . $model,
                'columns'        => $columns,
            ]
        );

        $filename = database_path(
            'factories' . DIRECTORY_SEPARATOR . str_replace(
                '\\',
                DIRECTORY_SEPARATOR,
                $namespace
            ) . DIRECTORY_SEPARATOR . $model . 'Factory.php'
        );

        $targetDir = dirname($filename);
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (!file_put_contents($filename, $content->render())) {
            throw new Exception('Can\'t write factory file!');
        }

        return $filename;
    }
}