<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('display_name')->nullable();
            $table->string('usr_email')->unique();
            $table->string('usr_phone')->nullable();
            $table->text('usr_address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('usr_password');
            $table->unsignedBigInteger('usr_aff_id')->default(0);
            $table->integer('usr_money')->default(0);
            $table->boolean('usr_aff_enabled')->default(1);
            
            
            
            
            
            
            
            $table->rememberToken();
            $table->timestamp('usr_lastlogin')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('usr_email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
