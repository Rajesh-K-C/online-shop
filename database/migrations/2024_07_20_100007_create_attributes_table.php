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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->timestamps();
        });

        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained('attributes');
            $table->string('value', 30);
            $table->timestamps();
        });

        Schema::create('product_attribute', function (Blueprint $table) {
            $table->foreignId('attribute_value_id')->constrained('attribute_values');
            $table->foreignId('product_item_id')->constrained('product_items');
            $table->primary(['attribute_value_id', 'product_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attributes');
    }
};
