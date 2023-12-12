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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');

            $table->string('name');
            $table->unsignedDecimal('price');
            $table->tinyinteger('count_room');
            $table->tinyinteger('max_capacity');
            $table->boolean('conditioner')->default(0);
            $table->boolean('tv')->default(0);
            $table->boolean('smoke')->default(0);
            $table->boolean('balcony')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
