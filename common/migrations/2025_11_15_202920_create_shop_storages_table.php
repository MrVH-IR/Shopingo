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
        Schema::create('shop_storages', function (Blueprint $table) {
            $table->id();
            $table->string('deliverer');
            $table->string('receiver');
            $table->text('description');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_storages');
    }
};
