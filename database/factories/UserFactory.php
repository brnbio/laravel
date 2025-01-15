<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            User::ATTRIBUTE_NAME           => $this->faker->name(),
            User::ATTRIBUTE_EMAIL          => $this->faker->unique()->safeEmail(),
            User::ATTRIBUTE_PASSWORD       => Hash::make('password'),
            User::ATTRIBUTE_REMEMBER_TOKEN => Str::random(100),
        ];
    }
}
