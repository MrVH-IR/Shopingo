<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $connection = 'sqlite';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_cyber_data', function (Blueprint $table) {
            $table->id();
            $table->ipAddress();
            $table->text('header');
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_cyber_data');
    }
};
