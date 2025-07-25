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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body');

            $table->morphs('commentable');

            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('parent_id')->constrained('comments');

            $table->tinyInteger('seen')->default(0)->comment('0 => for Unseen, 1 for Seen');
            $table->tinyInteger('approved')->default(0)->comment('0 for Unapproved, 1 for Approved');
            $table->tinyInteger('status')->default(0)->comment('0 for Inactive, 1 for Active');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
