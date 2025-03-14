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
            $table->enum('first_div', ['active' , 'disable']);
            $table->enum('second_div', ['active', 'disable']);
            $table->enum('third_div', ['active', 'disable']);
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
