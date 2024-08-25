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
        // Добавляем параметр Активного кабинета для пользователя
        Schema::table('user_cabinets', function (Blueprint $table) {
            $table->boolean('is_active')
                ->default(false)
                ->after('cabinet_id')
                ->comment('Активный кабинет для пользователя');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_cabinets', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
