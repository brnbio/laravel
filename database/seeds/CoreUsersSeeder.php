<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class CoreUsersSeeder
 */
class CoreUsersSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        factory(User::class, 10)->create();
    }
}
