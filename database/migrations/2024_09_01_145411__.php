<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Добавляем параметр Номера телефона для пользователя
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('phone')
                ->nullable()
                ->default(null)
                ->after('email')
                ->comment('Номер телефона');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
};
