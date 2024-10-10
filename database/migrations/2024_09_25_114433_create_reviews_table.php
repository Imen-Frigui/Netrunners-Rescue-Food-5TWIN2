<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->string('rating');
            $table->timestamps();
            $table->foreignId('user_id')->nullable()->onDelete('cascade');
            $table->foreignId('restaurant_id')->nullable()->onDelete('cascade');
            $table->foreignId('charity_id')->nullable()->onDelete('cascade');
            $table->foreignId('event_id')->nullable()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
