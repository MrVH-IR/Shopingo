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
        Schema::create('post_categories', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('slug')->unique()->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('tags');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_categories');
    }
};
