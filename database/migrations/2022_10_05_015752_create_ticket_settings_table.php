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
        Schema::create('ticket_settings', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('ticket_id');
            $table->boolean('is_per_pax');
            $table->integer('pax_constraint');
            $table->boolean('is_per_day');
            $table->integer('day_constraint');
            $table->boolean('is_per_age');
            $table->integer('age_constraint');
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_settings',function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropForeign('ticket_id');
        });
        Schema::dropIfExists('ticket_settings');
    }
};
