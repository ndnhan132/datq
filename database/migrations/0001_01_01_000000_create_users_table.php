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
            // $table->string('username')->unique();
            $table->string('display_name')->nullable();
            $table->string('usr_email')->unique()->nullable();
            $table->string('usr_phone')->unique();
            $table->text('usr_address')->nullable();
            $table->string('usr_password')->nullable();
            $table->unsignedBigInteger('usr_aff_id')->default(0);
            $table->integer('usr_money')->default(0);
            $table->boolean('usr_aff_enabled')->default(1);
            
            
            
            
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            
            $table->string('login_verify_code')->nullable();
            $table->timestamp('login_verify_created_at')->nullable();
            
            
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

        DB::statement('ALTER TABLE users AUTO_INCREMENT = 101010;');
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
