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
        Schema::create('deliveries', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('amount', 20, 2)->nullable();
            $table->integer('delivery_time');
            $table->string('delivery_time_unit')->comment('Unit Means Hours & Minutes & Days');
            $table->tinyInteger('status')->default(0)->comment('0 => Inactive, 1 => Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
