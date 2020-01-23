<?php

declare(strict_types=1);

namespace App\Console\Commands\GenerateCommand;

use App\Support\Str;
use Dbml\Dbml\Model\Table\Column;
use Exception;
use Throwable;

/**
 * Class SeederCreator
 * @package App\Console\Commands\GenerateCommand
 */
class SeederCreator
{
    /**
     * @param string $model
     * @param string $namespace
     * @return string
     * @throws Throwable
     */
    public function create(string $model, string $namespace): string
    {
        $content = view(
            'stubs.seeder',
            [
                'model'          => $model,
                'modelNamespace' => 'App\Models\\' . $namespace . '\\' . $model,
            ]
        );

        $filename = database_path(
            'seeds' .
            DIRECTORY_SEPARATOR .
            ucfirst(Str::camel(str_replace('\\', '_', $namespace))) . Str::plural($model) . 'Seeder.php'
        );
        if (!file_put_contents($filename, $content->render())) {
            throw new Exception('Can\'t write seeder file!');
        }

        return $filename;
    }
}