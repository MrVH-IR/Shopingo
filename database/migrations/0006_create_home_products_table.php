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
        Schema::create('home_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('first_div')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('second_div')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('third_div')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_products');
    }
};
