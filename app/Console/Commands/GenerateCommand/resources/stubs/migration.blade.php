{!! '<' . '?php' !!}

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class {{ $className }}
 */
class {{ $className }} extends Migration
{
    /**
     * {{ '@' . 'return void' }}
     */
    public function up(): void
    {
        Schema::create(
            '{{ $tableName }}',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->uuid('uuid');
                @foreach ($columns as $column)<?php
                    if (in_array($column->name, ['id', 'uuid'])) {
                        continue;
                    }
                    // TODO: implement other types
                    if ($column->type === 'int') {
                        echo '$table->integer(\'' . $column->name . '\')';
                    }
                    else {
                        echo '$table->string(\'' . $column->name . '\')';
                    }
                    if ($column->null) {
                        echo '->nullable()';
                    }
                    if (!empty($column->default)) {
                        echo '->default(\'' . trim($column->default) . '\')';
                    }
                ?>;
                @endforeach$table->timestamps();
            }
        );
    }

    /**
     * {{ '@' . 'return void' }}
     */
    public function down(): void
    {
        Schema::dropIfExists('{{ $tableName }}');
    }
}
