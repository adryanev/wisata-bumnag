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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->text('description');
            $table->text('adress');
            $table->string('phone_number');
            $table->string('email');
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamp('opening_hours')->nullable();
            $table->timestamp('closing_hours')->nullable();
            $table->string('instagram')->nullable();
            $table->integer('capasity')->nullable();
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
        Schema::dropIfExists('destinations');
    }
};
