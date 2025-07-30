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
        Schema::create('product_colors', static function (Blueprint $table) {
            $table->id();
            $table->string('color_name');
            $table->foreignId('product_id')->constrained('products')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('price_increase' , 20 , 2)->default(0)->comment('Price Added If Guarantee Exists on Product');
            $table->tinyInteger('sold_out')->default(0)->comment('How Many Have Been Sold');
            $table->tinyInteger('frozen_number')->default(0)->comment('How Many Frozen Number Of This Product Are In Cart');
            $table->tinyInteger('marketable_number')->default(0)->comment('How Many Market Number Of This Product Do We Have');
            $table->tinyInteger('status')->default(0)->comment('0=Inactive, 1=Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_colors');
    }
};
