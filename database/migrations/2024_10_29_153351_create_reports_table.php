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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('charity_id')->constrained()->onDelete('cascade'); // Foreign key to charity
            $table->enum('report_type', ['financial', 'performance', 'event summary', 'Volunteer Report'])->nullable();
            $table->text('content');             // Content of the report
            $table->date('report_date')->default(now()); // Default to the current timestamp
            $table->enum('status', ['pending', 'solved', 'rejected'])->default('pending'); // Status column added
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
        Schema::dropIfExists('reports');
    }
};
