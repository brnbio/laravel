<?php

declare(strict_types=1);

namespace App\Console\Commands\GenerateCommand;

use App\Support\Str;
use Dbml\Dbml\Model\Table\Column;
use Exception;
use Throwable;

/**
 * Class MigrationCreator
 * @package App\Console\Commands\GenerateCommand
 */
class MigrationCreator
{
    /**
     * @param string $tableName
     * @param Column[] $columns
     * @return string
     * @throws Throwable
     */
    public function create(string $tableName, array $columns): string
    {
        $className = ucfirst(Str::camel('create_' . $tableName . '_table'));
        $content = view(
            'stubs.migration',
            [
                'className' => $className,
                'tableName' => $tableName,
                'columns'   => $columns,
            ]
        );

        $filename = date('Y_m_d_His') . '_' . Str::snake($className) . '.php';
        if (!file_put_contents(database_path('migrations') . DIRECTORY_SEPARATOR . $filename, $content->render())) {
            throw new Exception('Can\'t write migration file. [' . $filename . ']');
        }

        return $filename;
    }
}