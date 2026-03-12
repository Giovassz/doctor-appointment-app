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
        Schema::table('appointments', function (Blueprint $table) {
            $table->index(['date', 'status']);
            $table->index('start_time');
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->index(['first_name', 'last_name']);
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->index('medical_license_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex(['date', 'status']);
            $table->dropIndex(['start_time']);
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->dropIndex(['first_name', 'last_name']);
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropIndex(['medical_license_number']);
        });
    }
};
