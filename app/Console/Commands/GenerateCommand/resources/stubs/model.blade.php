<?php

    /** @var Dbml\Model\Table $table */

    use App\Support\Str;
    use App\Console\Commands\GenerateCommand;
    use Dbml\Dbml;

?>{!! '<' . '?php' !!}

declare(strict_types=1);

namespace {{ $namespace }};

use App\Models\Model;
<?php
    // -- relationship usage
    $hasOne = $hasMany = $belongsTo = false;
    foreach ($table->relationships as $relationship) {
        ${$relationship->type} = true;
    }
    if ($belongsTo) {
        echo 'use Illuminate\Database\Eloquent\Relations\BelongsTo;' . PHP_EOL;
    }
    if ($hasOne) {
        echo 'use Illuminate\Database\Eloquent\Relations\HasOne;' . PHP_EOL;
    }
    if ($hasMany) {
        echo 'use Illuminate\Database\Eloquent\Relations\HasMany;' . PHP_EOL;
    }
    // datetype usages
    $carbon = false;
    foreach ($table->columns as $column) {
        if (GenerateCommand\Helper::getPhpDataType($column->type) === 'Carbon') {
            $carbon = true;
        }
    }
    if ($carbon) {
        echo 'use Illuminate\Support\Carbon;' . PHP_EOL;
    }
?>

/**
 * Class {{ $className }}
 * {{ '@' . 'package ' . $namespace }}
 */
class {{ $className }} extends Model
{
    public const TABLE = '{{ $table->name }}';{{PHP_EOL}}@foreach($table->columns as $column)
    {!! sprintf('public const ATTRIBUTE_%s = \'%s\';', strtoupper($column->name), $column->name) !!}{{ PHP_EOL }}@endforeach()@foreach($table->columns as $column)<?php

        $returnType = GenerateCommand\Helper::getPhpDataType($column->type);

    ?>

    /**
     * {{ '@' . 'return ' . $returnType . ($column->null ? '|null' : '') }}
     */
    public function get{{ ucfirst(\App\Support\Str::camel($column->name)) }}(): {{ ($column->null ? '?' : '') . $returnType }}
    {
        return $this->getAttribute(self::ATTRIBUTE_{{ strtoupper($column->name) }});
    }

    /**
     * {{ '@' . 'param ' . $returnType . ($column->null ? '|null' : '') . ' $' . \App\Support\Str::camel($column->name) }}
     * {{ '@' . 'return ' . $className }}
     */
    public function set{{ ucfirst(\App\Support\Str::camel($column->name)) }}({{ $returnType }} ${{ \App\Support\Str::camel($column->name) }}{{ ($column->null ? ' = null' : '') }}): {{ $className }}
    {
        return $this->setAttribute(self::ATTRIBUTE_{{ strtoupper($column->name) }}, ${{ \App\Support\Str::camel($column->name) }});
    }{{ PHP_EOL }}@endforeach()@foreach($table->relationships as $relationship)<?php
        $foreignModelInfo = GenerateCommand\Helper::getClassInfo($relationship->foreignTable->name);
        $function = Str::snake(Str::singular($foreignModelInfo['model']));
        if ($relationship->type === Dbml\Model\Table\Relationship::RELATIONSHIP_HAS_MANY) {
            $function = Str::snake(Str::plural($foreignModelInfo['model']));
        }
        $foreignModelClassName = str_replace($namespace . '\\', '', 'App\Models\\' . $foreignModelInfo['namespace'] . '\\' . $foreignModelInfo['model']);
        $foreignAttribute = $foreignModelClassName . '::ATTRIBUTE_' . strtoupper($relationship->foreignColumn->name);
        if ($relationship->type === Dbml\Model\Table\Relationship::RELATIONSHIP_BELONGS_TO) {
            $foreignAttribute = 'self::ATTRIBUTE_' . strtoupper($relationship->column->name);
        }
    ?>

    /**
     * {{ '@' . 'return ' . ucfirst($relationship->type) }}
     */
    public function {{ $function }}(): {{ ucfirst($relationship->type) }}
    {
        return $this->{{ $relationship->type }}({{ $foreignModelClassName }}::class, {{ $foreignAttribute }});
    }

    /**
     * {{ '@' . 'return ' . ($relationship->type === Dbml\Model\Table\Relationship::RELATIONSHIP_HAS_MANY ? $foreignModelClassName . '[]' : $foreignModelClassName) }}
     */
    public function get{{ ucfirst($function) }}(): {{ $relationship->type === Dbml\Model\Table\Relationship::RELATIONSHIP_HAS_MANY ? 'array' : $foreignModelClassName }}
    {
        return $this->getAttribute('{{ $function }}');
    }

    @endforeach/**
     * {{ '@' . 'param array $attributes' }}
     * {{ '@' . 'return ' . $className }}
     */
    public function fill(array $attributes): {{ $className }}
    {@foreach($table->columns as $column)

        if (!empty($attributes[self::ATTRIBUTE_{{ strtoupper($column->name) }}])) {
            $this->set{{ ucfirst(\App\Support\Str::camel($column->name)) }}($attributes[self::ATTRIBUTE_{{ strtoupper($column->name) }}]);
        }{{ PHP_EOL }}@endforeach()

        return $this;
    }
}
