<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use ReflectionClass;

class GenerateModelMigration extends Command
{
    protected $signature = 'generate:model-migration {model}';

    protected $description = 'Generate a migration file based on a model';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $modelName = $this->argument('model');
        $model = app("App\\$modelName");
        $tableName = $model->getTable();
        $schema = Schema::getConnection()->getDoctrineSchemaManager()->listTableDetails($tableName)->getColumns();

        $fields = collect($schema)->map(function ($field, $name) {
            return '$table->' . $this->getColumnDefinition($name, $field);
        })->implode("\n\t\t\t\t");

        $migrationFileName = date('Y_m_d_His') . '_create_' . Str::plural(Str::snake($tableName)) . '_table.php';
        $migrationFile = database_path('migrations/' . $migrationFileName);

        $stub = file_get_contents(base_path('stubs/migration.stub'));

        $stub = str_replace(['{{modelName}}', '{{fields}}'], [$modelName, $fields], $stub);

        file_put_contents($migrationFile, $stub);

        $this->info("Migration file created: $migrationFile");
    }

    private function getColumnDefinition($name, $field)
    {
        $type = $field->getType()->getName();
        return "string('$name')";
    }
}
