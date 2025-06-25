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
        Schema::create('visits', function (Blueprint $table) {
            $table->id('visit_id');
            $table->foreignId('showroom_id')->constrained('showrooms', 'showroom_id');
            $table->foreignId('customer_id')->constrained('customers', 'customer_id');
            $table->dateTime('visit_date');
            $table->text('notes')->nullable();
            // لا توجد طوابع زمنية حسب إعدادات النموذج
        });
    }

    /**
     * التراجع عن عمليات الهجرة.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};