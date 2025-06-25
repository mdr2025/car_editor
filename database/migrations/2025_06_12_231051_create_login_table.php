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
        Schema::create('login', function (Blueprint $table) {
            $table->id('login_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * التراجع عن عمليات الهجرة.
     */
    public function down(): void
    {
        Schema::dropIfExists('login');
    }
};