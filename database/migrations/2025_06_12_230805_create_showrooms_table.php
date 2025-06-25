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
        Schema::create('showrooms', function (Blueprint $table) {
            $table->id('showroom_id');
            $table->string('showroom_name');
            $table->string('location');
            $table->string('showroom_phone');
            $table->string('showroom_email');
            $table->string('working_hour');
            $table->string('showroom_status');
            $table->string('website_url')->nullable();
            $table->string('image_path')->nullable();
            // لا توجد طوابع زمنية حسب إعدادات النموذج
        });
    }

    /**
     * التراجع عن عمليات الهجرة.
     */
    public function down(): void
    {
        Schema::dropIfExists('showrooms');
    }
};