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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->foreignId('user_id')->index()->references('id')->on('users');
            $table->string('phone_number')->index();
            $table->string('email')->index();
            $table->text('address');
            $table->string('instagram')->index();
            $table->string('website')->index();
            $table->timestamp('opening_hours')->index();
            $table->timestamp('closing_hours')->index();
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
        Schema::dropIfExists('businesses');
    }
};
