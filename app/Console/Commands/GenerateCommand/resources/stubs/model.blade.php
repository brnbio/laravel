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
    public const TABLE = '{{ $table }}';{{PHP_EOL}}@foreach($attributes as $attribute)
    {!! sprintf('public const ATTRIBUTE_%s = \'%s\';', strtoupper($attribute['name']), $attribute['name']) !!}{{ PHP_EOL }}@endforeach()@foreach($attributes as $attribute)

    /**
     * {{ '@' . 'return ' . $attribute['type'] . (!empty($attribute['null']) ? '|null' : '') }}
     */
    public function get{{ ucfirst(\App\Support\Str::camel($attribute['name'])) }}(): {{ (!empty($attribute['null']) ? '?' : '') . $attribute['type'] }}
    {
        return $this->getAttribute(self::ATTRIBUTE_{{ strtoupper($attribute['name']) }});
    }

    /**
     * {{ '@' . 'param ' . $attribute['type'] . (!empty($attribute['null']) ? '|null' : '') . ' $' . $attribute['name'] }}
     * {{ '@' . 'return ' . $className }}
     */
    public function set{{ ucfirst(\App\Support\Str::camel($attribute['name'])) }}({{ $attribute['type'] }} ${{$attribute['name']}}{{ !empty($attribute['null']) ? ' = null' : '' }}): {{ $className }}
    {
        return $this->setAttribute(self::ATTRIBUTE_{{ strtoupper($attribute['name']) }}, ${{$attribute['name']}});
    }{{ PHP_EOL }}@endforeach

    /**
     * {{ '@' . 'param array $attributes' }}
     * {{ '@' . 'return ' . $className }}
     */
    public function fill(array $attributes): {{ $className }}
    {@foreach($attributes as $attribute)

        if (!empty($attributes[self::ATTRIBUTE_{{ strtoupper($attribute['name']) }}])) {
            $this->set{{ ucfirst(\App\Support\Str::camel($attribute['name'])) }}($attributes[self::ATTRIBUTE_{{ strtoupper($attribute['name']) }}]);
        }{{ PHP_EOL }}@endforeach()

        return $this;
    }
}
