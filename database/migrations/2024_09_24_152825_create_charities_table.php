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
        Schema::create('charities', function (Blueprint $table) {
            $table->id();
            $table->string('charity_name');
            $table->string('address');
            $table->json('contact_info')->nullable(); // JSON column for contact information
            $table->enum('charity_type', ['food_bank', 'shelter', 'soup_kitchen']);
            $table->integer('beneficiaries_count')->default(0);
            $table->string('preferred_food_types')->nullable(); // Set a default value
            $table->string('request_history')->nullable(); // History of requests
            $table->string('inventory_status')->nullable(); // Current inventory
            $table->timestamp('last_received_donation')->nullable(); // Last donation date
            $table->integer('donation_frequency')->default(0); // Frequency of donations
            $table->string('assigned_drivers_volunteers')->nullable(); // Assigned personnel
            $table->string('current_requests')->nullable(); // Pending food requests
            $table->decimal('charity_rating', 3, 2)->default(0); // Rating out of 5.00
            $table->enum('charity_approval_status', ['approved', 'pending', 'rejected'])->default('pending');
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
        Schema::dropIfExists('charities');
    }
};
