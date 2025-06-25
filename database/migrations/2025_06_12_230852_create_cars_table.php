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
        Schema::create('cars', function (Blueprint $table) {
            $table->id('car_id');
            $table->foreignId('inventory_id')->constrained('car_inventories', 'inventory_id');
            $table->string('car_name');
            $table->integer('model_year');
            $table->string('color');
            $table->string('vin');
            $table->string('seats');
            $table->integer('price');
            $table->string('image_path_url')->nullable();
            $table->string('wheels');
            $table->string('tires');
            $table->decimal('overall_length', 8, 2);
            $table->decimal('overall_width', 8, 2);
            $table->decimal('overall_height', 8, 2);
            $table->decimal('wheel_base', 8, 2);
            $table->decimal('front_wheel_tread', 8, 2);
            $table->decimal('rear_wheel_tread', 8, 2);
            $table->decimal('lightest_curb_weight', 8, 2);
            $table->decimal('heaviest_curb_weight', 8, 2);
            $table->decimal('gross_curb_weight', 8, 2);
            // لا توجد طوابع زمنية حسب إعدادات النموذج
        });
    }

    /**
     * التراجع عن عمليات الهجرة.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};