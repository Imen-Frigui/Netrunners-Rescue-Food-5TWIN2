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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id')->constrained('food')->onDelete('cascade'); // Ensure explicit reference to 'foods'
            $table->enum('donor_type', ['Restaurant', 'Individual', 'Charity']);
            // $table->unsignedBigInteger('donor_id')->nullable(); 
            $table->date('donation_date');
            $table->integer('quantity');
            $table->enum('status', ['Pending', 'Approved', 'Completed', 'Canceled'])->default('Pending');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('donations');
    }
};
