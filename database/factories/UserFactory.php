<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserFactory
 *
 * @package Database\Factories
 */
class UserFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * @return array|void
     */
    public function definition()
    {
        return [
            User::ATTRIBUTE_NAME               => $this->faker->name,
            User::ATTRIBUTE_EMAIL              => $this->faker->unique()->safeEmail,
            User::ATTRIBUTE_EMAIL_VERFIFIED_AT => now(),
            User::ATTRIBUTE_PASSWORD           => Hash::make('password'),
            User::ATTRIBUTE_REMEMBER_TOKEN     => Str::random(40),
        ];
    }
}