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
        Schema::table('event_sponsors', function (Blueprint $table) {
            $table->string('sponsorship_level')->nullable()->after('sponsor_id');
            $table->decimal('sponsorship_amount', 10, 2)->nullable()->after('sponsorship_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_sponsors', function (Blueprint $table) {
            $table->dropColumn('sponsorship_level');
            $table->dropColumn('sponsorship_amount');
        });
    }
};
