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
        Schema::create('job', function (Blueprint $table) {
            $table->id('job_id');
            $table->foreignId('employee_id')->constrained('employees', 'employee_id')->onDelete('cascade');
            $table->foreignId('showroom_id')->constrained('showrooms', 'showroom_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('working_status');
            $table->text('notes')->nullable();
            // لا توجد طوابع زمنية حسب إعدادات النموذج
        });
    }

    /**
     * التراجع عن عمليات الهجرة.
     */
    public function down(): void
    {
        Schema::dropIfExists('job');
    }
};