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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Restaurant name
            $table->string('address'); // Restaurant address
            $table->string('phone'); // Restaurant phone number
            $table->string('email')->unique(); // Restaurant email
            $table->decimal('longitude', 10, 7)->nullable(); // Longitude with precision for coordinates
            $table->decimal('latitude', 10, 7)->nullable(); // Latitude with precision for coordinates
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
        Schema::dropIfExists('restaurants');
    }
};
