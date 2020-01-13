<?php

declare(strict_types=1);

namespace App\Console\Commands\GenerateCommand;

use App\Support\Str;
use Exception;
use Throwable;

/**
 * Class ControllerCreator
 * @package App\Console\Commands\GenerateCommand
 */
class ControllerCreator
{
    /**
     * @param string $model
     * @param string $namespace
     * @param string $action
     * @return string
     * @throws Throwable
     */
    public function create(string $model, string $namespace, string $action): string
    {
        $modelNamespace = $namespace . '\\' . $model;
        $controllerNamespace = $namespace . '\\' . Str::plural($model);
        $route = Str::lower(Str::replace(['\\' => '.'], $controllerNamespace));
        $content = view(
            'stubs.controller.' . $action,
            [
                'model'          => $model,
                'modelNamespace' => $modelNamespace,
                'namespace'      => $controllerNamespace,
                'var'            => Str::snake($model),
                'vars'           => Str::snake(Str::plural($model)),
                'route'          => $route,
            ]
        );

        $path = 'Http' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . str_replace(
                '\\',
                DIRECTORY_SEPARATOR,
                $controllerNamespace
            );
        $filename = ucfirst($action) . 'Controller.php';

        if (!is_dir(app_path($path))) {
            mkdir(app_path($path), 0755, true);
        }
        if (!file_put_contents(app_path($path) . DIRECTORY_SEPARATOR . $filename, $content->render())) {
            throw new Exception('Can\'t write controller file. [' . $path . DIRECTORY_SEPARATOR . $filename . ']');
        }

        $this->addRoutes($model, $controllerNamespace, $action);

        return $path . DIRECTORY_SEPARATOR . $filename;
    }

    /**
     * @param string $model
     * @param string $namespace
     * @param string $action
     * @return string
     */
    private function addRoutes(string $model, string $namespace, string $action): string
    {
        $route = '';

        if ($action === 'index') {
            $route = sprintf(
                'Route::get (\'%s\', %s)->name(\'%s\');',
                '/' . Str::lower(Str::replace(['\\' => '/'], $namespace)),
                $namespace . '\\' . ucfirst($action) . 'Controller::class',
                Str::lower(Str::replace(['\\' => '.'], $namespace)) . '.index'
            );
        }

        if ($action === 'create') {
            $route = sprintf(
                    'Route::get (\'%s\', %s)->name(\'%s\');',
                    '/' . Str::lower(Str::replace(['\\' => '/'], $namespace)) . '/create',
                    $namespace . '\\' . ucfirst($action) . 'Controller::class',
                    Str::lower(Str::replace(['\\' => '.'], $namespace)) . '.create'
                ) . PHP_EOL;
            $route .= sprintf(
                'Route::post(\'%s\', [%s, \'store\']);',
                '/' . Str::lower(Str::replace(['\\' => '/'], $namespace)) . '/create',
                $namespace . '\\' . ucfirst($action) . 'Controller::class'
            );
        }

        if ($action === 'details') {
            $route = sprintf(
                'Route::get (\'%s\', %s)->name(\'%s\');',
                '/' . Str::lower(Str::replace(['\\' => '/'], $namespace)) . '/{' . Str::lower($model) . '}',
                $namespace . '\\' . ucfirst($action) . 'Controller::class',
                Str::lower(Str::replace(['\\' => '.'], $namespace)) . '.details'
            );
        }

        if ($action === 'update') {
            $route = sprintf(
                'Route::get (\'%s\', %s)->name(\'%s\');',
                '/' . Str::lower(Str::replace(['\\' => '/'], $namespace)) . '/{' . Str::lower($model) . '}/update',
                $namespace . '\\' . ucfirst($action) . 'Controller::class',
                Str::lower(Str::replace(['\\' => '.'], $namespace)) . '.update'
            ) . PHP_EOL;
            $route .= sprintf(
                'Route::post(\'%s\', [%s, \'store\']);',
                '/' . Str::lower(Str::replace(['\\' => '/'], $namespace)) . '/{' . Str::lower($model) . '}/update',
                $namespace . '\\' . ucfirst($action) . 'Controller::class'
            );
        }

        if ($action === 'delete') {
            $route = sprintf(
                'Route::post(\'%s\', %s)->name(\'%s\');',
                '/' . Str::lower(Str::replace(['\\' => '/'], $namespace)) . '/{' . Str::lower($model) . '}/delete',
                $namespace . '\\' . ucfirst($action) . 'Controller::class',
                Str::lower(Str::replace(['\\' => '.'], $namespace)) . '.' . $action
            );
        }

        $routes = base_path('routes/web.php');
        if (is_file($routes)) {
            // TODO: check if route exists
            file_put_contents($routes, PHP_EOL . $route, FILE_APPEND);
        }

        return $route;
    }
}