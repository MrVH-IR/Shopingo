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
        Schema::create('posts', static function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->text('summary')->nullable();
            $table->text('body');
            $table->text('image');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('commentable')->default(1)->comment('0 => Uncommentable, 1 => Commentable ');
            $table->string('tags');
            $table->timestamp('published_at');

            $table->foreignId('author_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('post_categories')->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
