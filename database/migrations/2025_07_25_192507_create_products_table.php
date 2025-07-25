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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('slug')->unique();
            $table->text('image');
            $table->decimal('weight', 10,2);
            $table->decimal('length', 10,1)->comment('CM Unit');
            $table->decimal('width', 10,1)->comment('CM Unit');
            $table->decimal('height', 10,1)->comment('CM Unit');
            $table->decimal('price', 20,3)->comment('Price');
            $table->tinyInteger('status')->default(0)->comment('0-Inactive, 1-Active');
            $table->tinyInteger('marketable')->default(0)->comment('0-Can Buy, 1-Can Not sell');
            $table->string('tags');
            $table->tinyInteger('sold_out')->default(0)->comment('How Many Have Been Sold');
            $table->tinyInteger('frozen_number')->default(0)->comment('How Many Frozen Number Of This Product Are In Cart');
            $table->tinyInteger('marketable_number')->default(0)->comment('How Many Market Number Of This Product Do We Have');
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_categories')->constrained('product_categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('published_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
