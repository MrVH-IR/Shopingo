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
        Schema::table('products', function (Blueprint $table) {
            $table->string('image_uri')->nullable()->after('stock');
        });

        Schema::table('active_products', function (Blueprint $table) {
            $table->string('image_uri')->nullable()->after('stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image_uri');
        });

        Schema::table('active_products', function (Blueprint $table) {
            $table->dropColumn('image_uri');
        });
    }
};
