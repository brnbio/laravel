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
                @foreach ($attributes as $attribute)<?php
                    if ($attribute['type'] === 'string') {
                        echo '$table->string(\'' . $attribute['name'] . '\')';
                    }
                    if( !empty($attribute['null'])) {
                        echo '->nullable()';
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
