<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Console\Commands\GenerateCommand\ControllerCreator;
use App\Console\Commands\GenerateCommand\MigrationCreator;
use App\Console\Commands\GenerateCommand\ModelCreator;
use App\Console\Commands\GenerateCommand\ViewCreator;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Throwable;

/**
 * Class GenerateCommand
 * @package App\Console\Commands
 */
class GenerateCommand extends Command
{
    /**
     * TODO: add options for model only, migration only etc.
     *
     * @var string
     */
    protected $signature = 'generate {--file= : Config file}';

    /**
     * @var string
     */
    protected $description = 'Generate complete app from db schema';

    /**
     * @return void
     * @throws Throwable
     */
    public function handle(): void
    {
        $tables = $this->getConfig();
        foreach ($tables as $k => $table) {
            $this->line('[' . ($k + 1) . '/' . count($tables) . '] ' . $table['name']);
            $this->generate($table);
        }

        $this->info(PHP_EOL . 'Done!');
    }

    /**
     * @return array
     */
    private function getConfig(): array
    {
        $filename = base_path($this->option('file') ?? 'db.json');
        if (!file_exists($filename)) {
            $this->error('Config file not found.');
            die();
        }
        $config = file_get_contents($filename);

        return json_decode($config, true);
    }

    /**
     * @param array $table
     * @return void
     * @throws Throwable
     */
    private function generate(array $table): void
    {
        $parts = explode('_', $table['name']);
        $model = Str::singular(ucfirst(array_pop($parts)));
        $namespace = ucwords(implode('\\', $parts), '\\');

        // -- database
        $this->generateMigration($table['name'], $table['attributes']);

        // -- mvc
        $this->generateModel('App\Models\\' . $namespace . '\\' . $model, $table['name'], $table['attributes']);
        $this->generateController($model, $namespace, ['index', 'create', 'details', 'update', 'delete']);
        $this->generateViews($model, $namespace, ['index', 'details', 'create', 'update'], $table['attributes']);

        /**
         * nice to have:
         * - associations
         * - factories
         * - validations
         * - change db.json to DSL (dbdiagram.io)
         */
    }

    /**
     * TODO: search for existing migration
     *
     * @param string $tableName
     * @param array $attributes
     * @return void
     * @throws Throwable
     */
    private function generateMigration(string $tableName, array $attributes): void
    {
        $creator = new MigrationCreator();
        $file = $creator->create($tableName, $attributes);

        $this->info('Created migration: ' . $file);
    }

    /**
     * @param string $name
     * @param string $tableName
     * @param array $attributes
     * @return void
     * @throws Throwable
     */
    private function generateModel(string $name, string $tableName, array $attributes): void
    {
        $creator = new ModelCreator();
        $file = $creator->create($name, $tableName, $attributes);

        $this->info('Created model: ' . $file);
    }

    /**
     * @param string $model
     * @param string $namespace
     * @param array $actions
     * @return void
     * @throws Throwable
     */
    private function generateController(string $model, string $namespace, array $actions): void
    {
        $creator = new ControllerCreator();
        foreach ($actions as $action) {
            $file = $creator->create($model, $namespace, $action);
            $this->info('Created controller: ' . $file);
        }
    }

    /**
     * @param string $model
     * @param string $namespace
     * @param array $actions
     * @param array $attributes
     * @return void
     * @throws Throwable
     */
    private function generateViews(string $model, string $namespace, array $actions, array $attributes): void
    {
        $creator = new ViewCreator();
        foreach ($actions as $action) {
            $file = $creator->create($model, $namespace, $action, $attributes);
            $this->info('Created view: ' . $file);
        }
    }
}
