<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersSeeder
 *
 * @package Database\Seeders
 */
class UsersSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([User::ATTRIBUTE_EMAIL => 'john.doe@example.org']);
        User::factory()->count(10)->create();
    }
}
