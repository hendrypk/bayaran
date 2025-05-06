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
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('pa_id')->nullable()->change();
            $table->integer('kpi_id')->nullable()->change();
            $table->integer('bobot_kpi')->nullable()->change();
            $table->integer('position_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('pa_id')->nullable(false)->change();
            $table->integer('kpi_id')->nullable(false)->change();
            $table->integer('bobot_kpi')->nullable(false)->change();
            $table->integer('position_id')->nullable()->change();
        });
    }
};
