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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_info')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['Individual', 'Organization', 'School', 'Hospital', 'Shelter', 'Community Center', 'Family']);
            $table->foreignId('managed_by')->constrained('users')->onDelete('set null'); 
            $table->enum('status', ['Active', 'Inactive'])->default('Active'); 
            $table->text('needs')->nullable();
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
        Schema::dropIfExists('beneficiaries');
    }
};
