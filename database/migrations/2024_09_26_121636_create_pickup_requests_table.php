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
        Schema::create('pickup_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('food_id');
            $table->string('pickup_address');
            $table->enum('status', ['pending', 'approved', 'in_progress', 'completed', 'cancelled', 'rejected'])->default('pending');
            $table->timestamp('request_time')->useCurrent();
            $table->timestamp('pickup_time')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign(columns: 'food_id')->references('id')->on('food')->onDelete('cascade');
            // $table->foreign(columns: 'driver_id')->references('id')->on('drivers')->onDelete('set null');
            $table->foreignId('driver_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('restaurant_id')->nullable()->onDelete('cascade');
            $table->foreignId('charity_id')->nullable()->onDelete('cascade');

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickup_requests');
    }
};
