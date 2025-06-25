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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id');
            $table->foreignId('customer_id')->constrained('customers', 'customer_id');
            $table->foreignId('car_id')->constrained('cars', 'car_id');
            $table->foreignId('employee_id')->constrained('employees', 'employee_id');
            $table->string('payment_method');
            $table->dateTime('sale_date');
            $table->decimal('total_price', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->text('notes')->nullable();
            // لا توجد طوابع زمنية حسب إعدادات النموذج
        });
    }

    /**
     * التراجع عن عمليات الهجرة.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};