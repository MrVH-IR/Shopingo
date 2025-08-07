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
        Schema::create('offline_payments', static function (Blueprint $table) {
            $table->id();
            $table->decimal('amount',20,3);
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('transaction_id')->nullable();
            $table->timestamp('paid_date')->useCurrent();
            $table->tinyInteger('status')->default(0)->comment('0-Inactive, 1-Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offline_payments');
    }
};
