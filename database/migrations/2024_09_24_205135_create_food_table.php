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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('food_name');
            $table->integer('quantity');
            $table->enum('unit', ['kg', 'liters', 'pieces']); 
            $table->date('expiration_date');
            $table->enum('category', ['fruit', 'vegetable', 'dairy', 'meat', 'grain', 'canned_food', 'beverage', 'baked_goods', 'seafood']); 
            $table->enum('status', ['available', 'expired', 'donated']);
            $table->enum('storage_conditions', ['refrigerated', 'frozen', 'ambient', 'dry', 'humidity_controlled', 'vacuum_sealed', 'cool_dark_place'])->nullable();
            $table->string('image')->nullable();
            $table->date('donation_date')->nullable();
            
            $table->foreignId('restaurant_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('charity_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('pickup_request_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('review_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
    }
};
