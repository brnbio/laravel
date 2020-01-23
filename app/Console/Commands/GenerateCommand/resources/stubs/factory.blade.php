{!! '<' . '?php' !!}

declare(strict_types=1);

use {{ $modelNamespace }};
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** {{ '@' . 'var Factory $factory' }} */
$factory->define(
    {{ $model }}::class,
    function (Faker $faker) {
        return [
        @foreach ($columns as $column)    {{ $model }}::ATTRIBUTE_{{ strtoupper($column->name) }} => $faker->{!! \App\Console\Commands\GenerateCommand\Helper::getFakerType($column) !!},
        @endforeach];
    }
);