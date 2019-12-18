<?php

declare(strict_types=1);

use App\Models\Core\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(
    User::class,
    function (Faker $faker) {
        return [
            User::ATTRIBUTE_NAME     => $faker->name,
            User::ATTRIBUTE_EMAIL    => $faker->unique()->safeEmail,
            User::ATTRIBUTE_PASSWORD => 'password',
        ];
    }
);
