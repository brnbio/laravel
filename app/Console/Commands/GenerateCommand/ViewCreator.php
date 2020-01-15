<?php

declare(strict_types=1);

namespace App\Console\Commands\GenerateCommand;

use App\Support\Str;
use Dbml\Dbml\Model\Table\Column;
use Exception;
use Throwable;

/**
 * Class ControllerCreator
 * @package App\Console\Commands\GenerateCommand
 */
class ViewCreator
{
    /**
     * @param string $model
     * @param string $namespace
     * @param string $action
     * @param Column[] $columns
     * @return string
     * @throws Throwable
     */
    public function create(string $model, string $namespace, string $action, array $columns): string
    {
        $controllerNamespace = $namespace . '\\' . Str::plural($model);
        $route = Str::lower(Str::replace(['\\' => '.'], $controllerNamespace));
        $content = view(
            'stubs.views.' . $action,
            [
                'model'   => $model,
                'var'     => Str::snake($model),
                'vars'    => Str::snake(Str::plural($model)),
                'route'   => $route,
                'columns' => $columns,
            ]
        );

        $path = 'views' . DIRECTORY_SEPARATOR . Str::replace(['.' => DIRECTORY_SEPARATOR], $route);
        $filename = Str::snake($action) . '.blade.php';

        if (!is_dir(resource_path($path))) {
            mkdir(resource_path($path), 0755, true);
        }
        if (!file_put_contents(resource_path($path) . DIRECTORY_SEPARATOR . $filename, $content->render())) {
            throw new Exception('Can\'t write view file. [' . $path . DIRECTORY_SEPARATOR . $filename . ']');
        }

        return $path . DIRECTORY_SEPARATOR . $filename;
    }
}