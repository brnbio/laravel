<?php

    use App\Console\Commands\GenerateCommand;
    use App\Support\Str;

?>{!! '<' . '?php' !!}

declare(strict_types=1);

use {{ $modelNamespace }};
use Illuminate\Database\Seeder;

/**
 * Class {{ Str::plural($model) }}Seeder
 */
class {{ Str::plural($model) }}Seeder extends Seeder
{
    /**
     * {{ '@' . 'return void' }}
     */
    public function run(): void
    {
        factory({{ $modelNamespace }}::class, {{ GenerateCommand::ENTITY_COUNT }})->create();
    }
}