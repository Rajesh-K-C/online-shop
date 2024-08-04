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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->string('description', 1000);
            $table->decimal('price'); // default 8, 2
            $table->decimal('discount_amount')->default(0);
            $table->decimal('discount_percent', 4)->default(0);
            $table->string('image');
            $table->integer('stock')->default(0);
            $table->integer('rank')->default(0);
            $table->boolean('status')->default(0);
            $table->integer('total_sales')->default(0);
            $table->foreignId('category_id')->constrained();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
