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
        Schema::create('amazing_common_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('discount');
            $table->unsignedBigInteger('discount_ceiling')->nullable();
            $table->unsignedBigInteger('discount_floor')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0-Inactive, 1-Active');
            $table->timestamp('start_at')->useCurrent();
            $table->timestamp('end_at')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amazing_common_discounts');
    }
};
