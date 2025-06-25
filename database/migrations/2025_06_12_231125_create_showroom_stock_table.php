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
        Schema::create('showroom_stock', function (Blueprint $table) {
            $table->foreignId('showroom_id')->constrained('showrooms', 'showroom_id')->onDelete('cascade');
            $table->foreignId('inventory_id')->constrained('car_inventories', 'inventory_id')->onDelete('cascade');
            $table->integer('quantity');
            $table->date('last_delivery_date');
            $table->string('status');
            $table->text('notes')->nullable();
            
            // تعريف المفتاح المركب
            $table->primary(['showroom_id', 'inventory_id']);
            
            // لا توجد طوابع زمنية حسب إعدادات النموذج
        });
    }

    /**
     * التراجع عن عمليات الهجرة.
     */
    public function down(): void
    {
        Schema::dropIfExists('showroom_stock');
    }
};