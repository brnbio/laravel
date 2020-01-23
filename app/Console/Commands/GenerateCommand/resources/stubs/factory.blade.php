<?php

    use App\Console\Commands\GenerateCommand\Helper;

?>{!! '<' . '?php' !!}

declare(strict_types=1);

use {{ $modelNamespace }};
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
<?php
    $hasCarbon = false;
    foreach ($columns as $column) {
        if (Helper::getPhpDataType($column->type)) {
            $hasCarbon = true;
        }
    }
    if ($hasCarbon) {
        echo 'use Illuminate\Support\Carbon;' . PHP_EOL;
    }
?>

/** {{ '@' . 'var Factory $factory' }} */
$factory->define(
    {{ $model }}::class,
    function (Faker $faker) {
        return [
        @foreach ($columns as $column)    {{ $model }}::ATTRIBUTE_{{ strtoupper($column->name) }} => {!! Helper::getFakerType($column) !!},
        @endforeach];
    }
);