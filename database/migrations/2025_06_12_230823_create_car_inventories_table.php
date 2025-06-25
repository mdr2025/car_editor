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
        Schema::create('car_inventories', function (Blueprint $table) {
            $table->id('inventory_id');
            $table->foreignId('showroom_id')->constrained('showrooms', 'showroom_id');
            $table->integer('quantity');
            $table->string('available_status');
            $table->text('notes')->nullable();
            // لا توجد طوابع زمنية حسب إعدادات النموذج
        });
    }

    /**
     * التراجع عن عمليات الهجرة.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_inventories');
    }
};