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
        Schema::create('cart_item_selected_attributes', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_item_id')->constrained('cart_items')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_attribute_id')->constrained('category_attributes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_value_id')->constrained('category_values')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_item_selected_attributes');
    }
};
