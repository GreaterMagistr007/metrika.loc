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
        Schema::create('cabinet_tariffs', function (Blueprint $table) {
            $table->unsignedBigInteger('cabinet_id');
            $table->unsignedBigInteger('tariff_id');

            $table->foreign('cabinet_id')
                ->comment('id кабинета из таблицы cabinets')
                ->references('id')
                ->on('cabinets')
                ->onDelete('cascade');

            $table->foreign('tariff_id')
                ->comment('id тарифа из таблицы tariffs')
                ->references('id')
                ->on('tariffs')
                ->onDelete('cascade');

            $table->date('date_paid')
                ->nullable()
                ->comment('Дата, когда последний раз был оплачен аккаунт');

            $table->date('date_til_paid')
                ->nullable()
                ->comment('Дата, до которой оплачен аккаунт');

            $table->unique(['cabinet_id', 'tariff_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabinet_tariffs');
    }
};
