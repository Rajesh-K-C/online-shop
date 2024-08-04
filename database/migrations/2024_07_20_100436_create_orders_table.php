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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->decimal('sub_total', 10);
            $table->decimal('total_discount', 10)->default(0);
            $table->decimal('grand_total', 10);
            $table->tinyInteger('status')->default(0);
//            $table->enum('status', ['Pending', 'Confirmed', 'Processing','Shipped','OutForDelivery','Delivered','Cancelled','Returned']);
            $table->string('phone_number',20);
            $table->string('shipping_address');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('delivery_agent')->nullable();
            $table->timestamps();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('delivery_agent')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
