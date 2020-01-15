{!! '<' . '?php' !!}

declare(strict_types=1);

namespace {{ $namespace }};

use App\Models\Model;

/**
 * Class {{ $className }}
 * {{ '@' . 'package ' . $namespace }}
 */
class {{ $className }} extends Model
{
    public const TABLE = '{{ $table }}';{{PHP_EOL}}@foreach($columns as $column)
    {!! sprintf('public const ATTRIBUTE_%s = \'%s\';', strtoupper($column->name), $column->name) !!}{{ PHP_EOL }}@endforeach()@foreach($columns as $column)<?php

        $returnType = $column->type;
        if ($column->type === 'varchar') {
            $returnType = 'string';
        }

    ?>

    /**
     * {{ '@' . 'return ' . $returnType . ($column->null ? '|null' : '') }}
     */
    public function get{{ ucfirst(\App\Support\Str::camel($column->name)) }}(): {{ ($column->null ? '?' : '') . $returnType }}
    {
        return $this->getAttribute(self::ATTRIBUTE_{{ strtoupper($column->name) }});
    }

    /**
     * {{ '@' . 'param ' . $returnType . ($column->null ? '|null' : '') . ' $' . $column->name }}
     * {{ '@' . 'return ' . $className }}
     */
    public function set{{ ucfirst(\App\Support\Str::camel($column->name)) }}({{ $returnType }} ${{$column->name}}{{ ($column->null ? ' = null' : '') }}): {{ $className }}
    {
        return $this->setAttribute(self::ATTRIBUTE_{{ strtoupper($column->name) }}, ${{$column->name}});
    }{{ PHP_EOL }}@endforeach

    /**
     * {{ '@' . 'param array $attributes' }}
     * {{ '@' . 'return ' . $className }}
     */
    public function fill(array $attributes): {{ $className }}
    {@foreach($columns as $column)

        if (!empty($attributes[self::ATTRIBUTE_{{ strtoupper($column->name) }}])) {
            $this->set{{ ucfirst(\App\Support\Str::camel($column->name)) }}($attributes[self::ATTRIBUTE_{{ strtoupper($column->name) }}]);
        }{{ PHP_EOL }}@endforeach()

        return $this;
    }
}
