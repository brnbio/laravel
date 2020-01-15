<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Console\Commands\GenerateCommand\ControllerCreator;
use App\Console\Commands\GenerateCommand\MigrationCreator;
use App\Console\Commands\GenerateCommand\ModelCreator;
use App\Console\Commands\GenerateCommand\ViewCreator;
use Dbml\Dbml;
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
     * @var array
     */
    protected $skipTables = [
        'core_users',
    ];

    /**
     * @var array
     */
    protected $skipColumns = [
        'id',
        'uuid',
        'created_at',
        'updated_at',
    ];

    /**
     * @return void
     * @throws Throwable
     */
    public function handle(): void
    {
        $tables = $this->getConfig()->tables;
        foreach ($tables as $k => $table) {

            $this->line('[' . ($k + 1) . '/' . count($tables) . '] ' . $table->name);

            // -- skip tables and remove skipped columns
            if (in_array($table->name, $this->skipTables)) {
                $this->info('Skipped!');
            } else {
                foreach ($table->columns as $k => $column) {
                    if (in_array($column->name, $this->skipColumns)) {
                        unset($table->columns[$k]);
                    }
                }
                $this->generate($table);
            }
        }

        $this->info(PHP_EOL . 'Done!');
    }

    /**
     * @return Dbml
     */
    private function getConfig(): Dbml
    {
        $filename = base_path($this->option('file') ?? 'schema.dbml');
        if (!file_exists($filename)) {
            $this->error('Config file not found.');
            die();
        }

        return new Dbml($filename);
    }

    /**
     * @param Dbml\Model\Table $table
     * @return void
     * @throws Throwable
     */
    private function generate(Dbml\Model\Table $table): void
    {
        $parts = explode('_', $table->name);
        $model = Str::singular(ucfirst(array_pop($parts)));
        $namespace = ucwords(implode('\\', $parts), '\\');

        // -- database
        $this->generateMigration($table->name, $table->columns);

        // -- mvc
        $this->generateModel('App\Models\\' . $namespace . '\\' . $model, $table->name, $table->columns);
        $this->generateController($model, $namespace, ['index', 'create', 'details', 'update', 'delete']);
        $this->generateViews($model, $namespace, ['index', 'details', 'create', 'update'], $table->columns);

        /**
         * nice to have:
         * - associations
         * - factories
         * - validations
         */
    }

    /**
     * TODO: search for existing migration
     *
     * @param string $tableName
     * @param Dbml\Model\Table\Column[] $columns
     * @return void
     * @throws Throwable
     */
    private function generateMigration(string $tableName, array $columns): void
    {
        $creator = new MigrationCreator();
        $file = $creator->create($tableName, $columns);

        $this->info('Created migration: ' . $file);
    }

    /**
     * @param string $name
     * @param string $tableName
     * @param Dbml\Model\Table\Column[] $columns
     * @return void
     * @throws Throwable
     */
    private function generateModel(string $name, string $tableName, array $columns): void
    {
        $creator = new ModelCreator();
        $file = $creator->create($name, $tableName, $columns);

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
     * @param Dbml\Model\Table\Column[] $columns
     * @return void
     * @throws Throwable
     */
    private function generateViews(string $model, string $namespace, array $actions, array $columns): void
    {
        $creator = new ViewCreator();
        foreach ($actions as $action) {
            $file = $creator->create($model, $namespace, $action, $columns);
            $this->info('Created view: ' . $file);
        }
    }
}
