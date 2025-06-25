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
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('showroom_id')->constrained('showrooms', 'showroom_id');
            $table->date('hire_date');
            $table->string('position');
            $table->decimal('salary', 10, 2);
            $table->string('department');
            $table->string('employee_status');
            $table->text('notes')->nullable();
            // لا توجد طوابع زمنية حسب إعدادات النموذج
        });
    }

    /**
     * التراجع عن عمليات الهجرة.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};