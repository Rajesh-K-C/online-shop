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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_name')->unique();
            $table->string('website_name');
            $table->string('slogan')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('header_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('phone_optional', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('google_map_link')->nullable();
            $table->string('about_us',1000)->nullable();
            $table->string('opening_hours')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('settings');
    }
};
