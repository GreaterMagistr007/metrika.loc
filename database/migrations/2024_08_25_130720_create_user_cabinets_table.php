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
        Schema::create('user_cabinets', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cabinet_id');

            $table->foreign('user_id')
                ->comment('id пользователя из таблицы users')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('cabinet_id')
                ->comment('id кабинета из таблицы cabinets')
                ->references('id')
                ->on('cabinets')
                ->onDelete('cascade');

            // Нужно будет добавить еще какие-нибудь опции пользователя в кабинете и права, но это будет позже - по мере необходимости

            $table->unique(['user_id', 'cabinet_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_cabinets');
    }
};
