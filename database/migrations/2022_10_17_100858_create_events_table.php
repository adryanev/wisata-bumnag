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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->text('description');
            $table->text('address');
            $table->string('phone_number');
            $table->string('email');
            $table->double('latitude');
            $table->double('lognitude');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->text('term_and_condition');
            $table->string('instagram')->nullable();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('events');
    }
};
