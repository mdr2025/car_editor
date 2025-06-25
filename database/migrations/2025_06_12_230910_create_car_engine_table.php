<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * تنفيذ عمليات الهجرة.
     */
    public function up(): void
    {
        Schema::create('car_engine', function (Blueprint $table) {
            $table->id('engine_id');
            $table->foreignId('car_id')->constrained('cars', 'car_id')->onDelete('cascade');
            $table->string('engine_name');
            $table->decimal('engine_capacity', 8, 1);
            $table->string('tranmission_type');
            $table->string('fuel_type');
            $table->decimal('fuel_tank_capacity', 8, 2);
            $table->integer('max_speed');
            $table->decimal('acceleration', 8, 2);
            $table->decimal('breaking_distance', 8, 2);
            $table->decimal('max_power', 8, 2);
            $table->decimal('max_torque', 8, 2);
            $table->decimal('displacement', 8, 1);
            $table->integer('number_cylinders');
            $table->integer('valves_of_cylinders');
            // لا توجد طوابع زمنية حسب إعدادات النموذج
        });
    }

    /**
     * التراجع عن عمليات الهجرة.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_engine');
    }
};