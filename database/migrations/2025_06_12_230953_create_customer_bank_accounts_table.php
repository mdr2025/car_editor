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
        Schema::create('customer_bank_accounts', function (Blueprint $table) {
            $table->id('account_id');
            $table->foreignId('customer_id')->constrained('customers', 'customer_id')->onDelete('cascade');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_holder_name');
            $table->string('iban');
            // لا توجد طوابع زمنية حسب إعدادات النموذج
        });
    }

    /**
     * التراجع عن عمليات الهجرة.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_bank_accounts');
    }
};