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
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->foreignId('user_id')->constrained('users');
            $table->string('otp_code');
            $table->string('login_id')->comment('Email address OR Mobile Number');
            $table->boolean('type')->default(0)->comment('0: Mobile , 1: Email');
            $table->boolean('used')->default(0)->comment('0: Not Used, 1: Used');
            $table->boolean('status')->default(0)->comment('0: Inactive, 1: Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
