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
        Schema::create('destination_certifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('destination_id');
            $table->string('certification_name');
            $table->string('certification_badge');
            $table->timestamp('acquired_date');
            $table->timestamp('expiration_date');
            $table->string('grade');
            $table->timestamps();

            $table->foreign('destination_id')->references('id')->on('destinations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destination_certifications');
    }
};
