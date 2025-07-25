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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->longText('description');
            $table->integer('status')->default(0)->comment('0 for Inactive, 1 for Active');
            $table->integer('seen')->default(0)->comment('0 for Have Not Seen, 1 for Seen');

            $table->foreignId('reference_id')->constrained('ticket_admins')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('ticket_categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('priority_id')->constrained('ticket_priorities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('ticket_id')->nullable()->constrained('tickets')->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
