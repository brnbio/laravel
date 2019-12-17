<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCoreUsersPasswordResetsTable
 */
class CreateCoreUsersPasswordResetsTable extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('core_users_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('core_users_password_resets');
    }
}
